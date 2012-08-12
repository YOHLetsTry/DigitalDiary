<?php

class OAuth_Provider_Flickr extends OAuth_Provider {

	public $name = 'flickr';

	public function url_request_token()
	{
		return 'http://www.flickr.com/services/oauth/request_token';
	}

	public function url_authorize()
	{
		return 'http://www.flickr.com/services/oauth/authorize';
	}

	public function url_access_token()
	{
		return 'http://www.flickr.com/services/oauth/access_token';
	}
	
	public function get_user_info(OAuth_Consumer $consumer, OAuth_Token $token)
	{
		// Create a new GET request with the required parameters
		$request = OAuth_Request::forge('resource', 'GET', 'http://api.flickr.com/services/rest', array(
			'oauth_consumer_key' => $consumer->key,
			'oauth_token' => $token->access_token,
			'nojsoncallback' => 1,
			'format' => 'json',
			'method' => 'flickr.test.login',
		));

		// Sign the request using the consumer and token
		$request->sign($this->signature, $consumer, $token);

		$response = json_decode($request->execute(), true);

		// Create a response from the request
		return array(
			'uid' => $response['user']['id'],
			'name' => $response['user']['username']['_content'],
			'nickname' => $response['user']['username']['_content'],
		);
	}
	
public function get_user_photo(OAuth_Consumer $consumer, OAuth_Token $token, $uid,$api_key)
	{
		// Create a new GET request with the required parameters
		$request = OAuth_Request::forge('resource', 'GET', 'http://api.flickr.com/services/rest', array(
			'oauth_consumer_key' => $consumer->key,
			'oauth_token' => $token->access_token,
			'nojsoncallback' => 1,
			'format' => 'json',
			'method' => 'flickr.people.getPublicPhotos',
			'api_key'=>$api_key,
			'user_id'=>$uid,
			
		));

		// Sign the request using the consumer and token
		$request->sign($this->signature, $consumer, $token);

		$response = json_decode($request->execute(), true);
		return $response;
	}

	public function get_photo_info(OAuth_Consumer $consumer, OAuth_Token $token,$api_key,$photo_id)
	{
		// Create a new GET request with the required parameters
		$request = OAuth_Request::forge('resource', 'GET', 'http://api.flickr.com/services/rest', array(
			'oauth_consumer_key' => $consumer->key,
			'oauth_token' => $token->access_token,
			'nojsoncallback' => 1,
			'format' => 'json',
			'method' => 'flickr.photos.getInfo',
			'api_key'=>$api_key,
			'photo_id'=>$photo_id,
			));

		// Sign the request using the consumer and token
		$request->sign($this->signature, $consumer, $token);

		$response = json_decode($request->execute(), true);
		return $response;
	}
			
} // End Provider_Flickr