"""Extract Indonesia's address ranges from a DB-IP Country Lite CSV.gz release."""

import argparse
import csv
import gzip
from ipaddress import ip_address
from pathlib import Path


def packed(address):
    ip = ip_address(address)
    if ip.version == 4:
        return ip_address(f"::ffff:{ip}").packed
    return ip.packed


if __name__ == "__main__":
    parser = argparse.ArgumentParser(description=__doc__)
    parser.add_argument("archive", type=Path)
    args = parser.parse_args()

    with gzip.open(args.archive, "rt", encoding="utf-8", newline="") as source:
        ranges = sorted(
            (packed(first), packed(last))
            for first, last, country in csv.reader(source)
            if country == "ID"
        )

    if not ranges or any(first > last for first, last in ranges):
        parser.error("The archive contains no valid Indonesian address ranges.")
    if any(previous[1] >= current[0] for previous, current in zip(ranges, ranges[1:])):
        parser.error("The archive contains overlapping Indonesian address ranges.")

    output = Path(__file__).resolve().parents[1] / "content/geoip/indonesia.bin"
    output.parent.mkdir(parents=True, exist_ok=True)
    temporary = output.with_suffix(".tmp")
    temporary.write_bytes(b"".join(first + last for first, last in ranges))
    temporary.replace(output)
    print(f"Wrote {len(ranges)} ranges to {output}")
