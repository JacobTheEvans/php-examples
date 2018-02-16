#!/usr/bin/env python
from geoip import geolite2
import sys

def find(ip):
	try:
		match = geolite2.lookup(ip)
	except ValueError:
		print("[-] Not Valid IP")
		sys.exit(0)

	continent = match.continent
	country = match.country
	state = iter(match.subdivisions).next()
	cord = match.location
	return("Continent: %s\nCountry: %s\nState: %s\nCoordinates: %s" %(continent,country,state,cord))


def main(argv):
	if len(argv) > 1 or len(argv) < 1:
		sys.exit(0)

	data = find(argv[-1])
	print(data)

if __name__ == "__main__":
	main(sys.argv[1:])