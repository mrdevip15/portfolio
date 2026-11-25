# Indonesia IP ranges

`indonesia.bin` uses the November 2026 release of [DB-IP IP to Country Lite](https://db-ip.com/db/lite.php), licensed under [CC BY 4.0](https://creativecommons.org/licenses/by/4.0/). It contains only Indonesia's ranges, sorted by starting address. Each record stores the two inclusive endpoints in network byte order as 16-byte addresses. IPv4 addresses are stored as IPv4-mapped IPv6 addresses.

Download the latest Country Lite CSV archive from DB-IP, regenerate the binary, and update the release month above.

```sh
python3 docs/update-indonesia-ip-ranges.py /path/to/dbip-country-lite-YYYY-MM.csv.gz
```
