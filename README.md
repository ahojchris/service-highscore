# High-score Service

This is an implementation of [melvint's](https://github.com/melvinmt) [PHP Backend Challenge](https://github.com/melvinmt/php-challenge). It is a RESTful service, written in PHP, that allows a game to post a user's score for ranking on a leaderboard. The implementation does not rely on any third-party frameworks or libraries. Composer is used for basic autoloading functionality.


# Generating Test Data

Test data can be generated by sending a `POST` request to `/seeder`. You must include a `num` key along with a corresponding value (e.g.: `num` = `1000000`).

```
POST  /seeder`
```
#### Parameters

| Name | Type | Description |
| --- | --- | --- |
| num | int | Required. Number of test records to generate |

# Recording Scores

Individual score entries can be recorded by sending a `POST` request to `/score`. You must include a valid `signed_request` and key/value pair, as well as a user_score key/value pair.


```
POST  /score
```
#### Parameters

| Name | Type | Description |
| --- | --- | --- |
| signed_request | string | *Required.* Signed request from Facebook |
| user_score | int | *Required.* User score |


# Reporting

Reports be generated by sending `GET` requests to the following endpoints:


Daily and all-time total number of players:
```
GET  /report/totals
```


Top 10 players (by score):
```
GET  /report/top
```


Top {num} players (by score):
```
GET  /report/top/num
```


Most improved as compared with last week:
```
GET  /report/improved
```


All reports above combined:
```
GET  /report
 ```

# Reference Data

The following Facebook application data and signed request has been used:

```
appId:
126767144061773

secret:
21db65a65e204cca7b5afcbad91fea59

signed_request:
cjv1NZlSRCthYq9rAyWEidD7QE98p0PKZvVwpQ7gPwg.eyJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImV4cGlyZXMiOjEzMjI4NTYwMDAsImlzc3VlZF9hdCI6MTMyMjg1MDc1NCwib2F1dGhfdG9rZW4iOiJBQUFCelMwYVhTMDBCQUlob0I1bmhrYnZJU0xLSGpNb3ZIN2ZTTmMzWkFxbnVNT2NvYmpJUHoxNGFmWXV1dzBkbkZzeVpBV2JHU2MycXZBakdjRzZUQ1RWZzBLOUVGUWJ5WkJwNTU0ZXE5M2FTWkFXZXpVeEYiLCJ1c2VyIjp7ImNvdW50cnkiOiJ1cyIsImxvY2FsZSI6ImVuX1VTIiwiYWdlIjp7Im1pbiI6MjF9fSwidXNlcl9pZCI6IjEwMDAwMzI5MTY2MTkwOSJ9
```

The encoded signed_request above contains the following data:

```
{
	"algorithm": "HMAC-SHA256",
	"expires": 1322856000,
	"issued_at": 1322850754,
	"oauth_token": "AAABzS0aXS00BAIhoB5nhkbvISLKHjMovH7fSNc3ZAqnuMOcobjIPz14afYuuw0dnFsyZAWbGSc2qvAjGcG6TCTVg0K9EFQbyZBp554eq93aSZAWezUxF",
	"user": {
		"country": "us",
		"locale": "en_US",
		"age": {
			"min": 21
		}
	}
	"user_id": "100003291661909"
}
```

# To Dos
Due to time constraints, this version only uses a single `scores` table to handle score records. A future version would include a `users` table containing at minimum `fname`, `lname`, and `fb_user_id`, fields , while removing `fb_user_id` and adding `user_id` to the `scores` table. New scores would begin with a select in the users table to get the user id from the fb_user_id, then an insert to scores with the user_id. Final reports would include a left outer join with `users` on user.id = scores.user_id, or something similar.
