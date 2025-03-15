## Submission Link:

https://codehawks.cyfrin.io/c/2023-12-the-standard/s/113

## Submission Details

No access control for the burn function
by alchmy0

## Relevant GitHub Links
https://github.com/Cyfrin/2023-12-the-standard/blob/main/contracts/SmartVaultV3.sol#L169

## Summary

No access control for the burn function

## Vulnerability Details

The burn function does not have an access control mechanism

## Impact

This can cause unauthorized burning of tokens

## Tools Used

VS Code

## Recommendations

An adjustment similar to the form below will initiate an access control mechanism: function burn(uint256 _amount) external onlyOwner ifMinted(_amount)
