import geoip2.database
import folium
from folium.plugins import HeatMap
import pandas as pd

def create_heatmap(log_file):
    reader = geoip2.database.Reader('GeoLite2-City.mmdb')  # Download from MaxMind
    ips = []
    with open(log_file, 'r') as file:
        for line in file:
            ip = line.split()[0]
            try:
                response = reader.city(ip)
                ips.append([response.location.latitude, response.location.longitude])
            except:
                pass
    map = folium.Map(location=[0, 0], zoom_start=2)
    HeatMap(ips).add_to(map)
    map.save('heatmap.html')
    print("Heatmap saved to heatmap.html")

def main():
    log_file = input("Enter log file path: ")
    create_heatmap(log_file)

if __name__ == "__main__":
    main()
