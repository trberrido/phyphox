#!/usr/bin/env python3
import sys
import json

def double(n):
    return n * 2

def negatif(n):
	return n * -1

with open (sys.argv[1]) as fd :
	jsondata = json.load(fd)

	arr = []
	arr.append(jsondata['phyphoxData'])
	obj = {
		'fitone': [jsondata['phyphoxData'][0][0], list(map(double, jsondata['phyphoxData'][0][1]))],
		'fittwo': [jsondata['phyphoxData'][0][0], list(map(negatif, jsondata['phyphoxData'][0][1]))],
	}
	arr.append(obj)
	fp = open(sys.argv[2], 'w+')
	json.dump(arr, fp)