from urllib.parse import urlparse
import redis

def main(args):
    redis_url = args.get("redis_url", '')
    parsed = urlparse(redis_url)
    redis_client = redis.StrictRedis(
	host=parsed.hostname,
	port=parsed.port,
	password=parsed.password,
	decode_responses=True)

    code = args['request']['intent']['slots']['Code']['value'].upper()
    airport1 = redis_client.hgetall("code:" + code)
    airport_info = "Airport code " + code + " is for " + airport1['name'] + " in " + airport1['country']
    print (airport_info);

    speech = {"type": "PlainText", "text": airport_info}
    response = {"shouldEndSession": "true", "outputSpeech": speech}
    output = {"version": "1.0", "response": response}
    return output

