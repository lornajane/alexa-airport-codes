# Airport Codes As A Service

Data from http://ourairports.com/data/

Put data in Redis so it looks like this (see `data/` directory for hacky PHP script):

```
hgetall code:CWL
1) "name"
2) "Cardiff International Airport"
3) "country"
4) "United Kingdom"
```

## Python Dependencies

Use a virtualenv, and `pip install redis` into it (more info in James' post: http://jamesthom.as/blog/2017/04/27/python-packages-in-openwhisk/)

## Running the code on OpenWhisk (or IBM Cloud Functions)

Create a package called `pydemo` and set a parameter `redis_url` on the package containing the URL to your redis instance

Run `./deploy.sh`

This is intended to be invoked by an Alexa skill, so it looks for a specific incoming data format and returns what Alexa expects
