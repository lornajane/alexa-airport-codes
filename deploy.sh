#!/bin/bash

zip -r airport.zip __main__.py virtualenv/lib/python3.6/site-packages/ virtualenv/bin/activate_this.py
bx wsk action update pydemo/airport --kind python:3 --web true airport.zip

