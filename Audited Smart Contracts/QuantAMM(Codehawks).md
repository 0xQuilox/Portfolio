Submission Link:
https://codehawks.cyfrin.io/c/2024-12-quantamm/s/159/

Submission Details:

Users can escape fees due to no edge case handling
by alchmy0

Summary

Users can escape fees due to no edge case handling

Vulnerability Details

Observing the onAfterSwap function in the UpliftOnlyExample contract:

function onAfterSwap(
        AfterSwapParams calldata params
    ) public override onlyVault returns (bool success, uint256 hookAdjustedAmountCalculatedRaw) {
        hookAdjustedAmountCalculatedRaw = params.amountCalculatedRaw;
        if (hookSwapFeePercentage > 0) {
            uint256 hookFee = params.amountCalculatedRaw.mulUp(hookSwapFeePercentage);

            if (hookFee > 0) {
                IERC20 feeToken;

                // Note that we can only alter the calculated amount in this function. This means that the fee will be
                // charged in different tokens depending on whether the swap is exact in / out, potentially breaking
                // the equivalence (i.e., one direction might "cost" less than the other).

                if (params.kind == SwapKind.EXACT_IN) {
                    // For EXACT_IN swaps, the `amountCalculated` is the amount of `tokenOut`. The fee must be taken
                    // from `amountCalculated`, so we decrease the amount of tokens the Vault will send to the caller.
                    //
                    // The preceding swap operation has already credited the original `amountCalculated`. Since we're
                    // returning `amountCalculated - hookFee` here, it will only register debt for that reduced amount
                    // on settlement. This call to `sendTo` pulls `hookFee` tokens of `tokenOut` from the Vault to this
                    // contract, and registers the additional debt, so that the total debits match the credits and
                    // settlement succeeds.
                    feeToken = params.tokenOut;
                    hookAdjustedAmountCalculatedRaw -= hookFee;
                } else {
                    // For EXACT_OUT swaps, the `amountCalculated` is the amount of `tokenIn`. The fee must be taken
                    // from `amountCalculated`, so we increase the amount of tokens the Vault will ask from the user.
                    //
                    // The preceding swap operation has already registered debt for the original `amountCalculated`.
                    // Since we're returning `amountCalculated + hookFee` here, it will supply credit for that increased
                    // amount on settlement. This call to `sendTo` pulls `hookFee` tokens of `tokenIn` from the Vault to
                    // this contract, and registers the additional debt, so that the total debits match the credits and
                    // settlement succeeds.
                    feeToken = params.tokenIn;
                    hookAdjustedAmountCalculatedRaw += hookFee;
                }

                uint256 quantAMMFeeTake = IUpdateWeightRunner(_updateWeightRunner).getQuantAMMUpliftFeeTake();
                uint256 ownerFee = hookFee;

                if (quantAMMFeeTake > 0) {
                    uint256 adminFee = hookFee / (1e18 / quantAMMFeeTake);
                    ownerFee = hookFee - adminFee;
                    address quantAMMAdmin = IUpdateWeightRunner(_updateWeightRunner).getQuantAMMAdmin();
                    _vault.sendTo(feeToken, quantAMMAdmin, adminFee);
                    emit SwapHookFeeCharged(quantAMMAdmin, feeToken, adminFee);
                }

                if (ownerFee > 0) {
                    _vault.sendTo(feeToken, address(this), ownerFee);

                    emit SwapHookFeeCharged(address(this), feeToken, ownerFee);
                }
            }
        }
        return (true, hookAdjustedAmountCalculatedRaw);
    }
