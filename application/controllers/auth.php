<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{	
	
	public function oauth($provider,$useremail='',$mobile='')
    {
        //$this->load->helper('url');
		$this->load->model('Data_model');
		
		$this->load->spark('oauth/0.3.1');

        // Create an consumer from the config
        $consumer = $this->oauth->consumer(array(
            'key' =>$this->config->item($provider.'_key'),
            'secret' => $this->config->item($provider.'_secret'),
        ));

		$provider_name= $provider;
        // Load the provider
        $provider = $this->oauth->provider($provider);

        if ( ! $this->input->get_post('oauth_token'))
        {
			if($useremail == "")
			{			
				redirect("http://dgtldiary.phpfogapp.com/");
			}
			if($mobile == "mobile")
			{$this->session->set_userdata('$mobile',"1");}
			$this->session->set_userdata('$user_email',$useremail);
			//$this->session->set_userdata('$mobile',$mobile);
			// Create the URL to return the user to
			
			$callback = "http://dgtldiary.phpfogapp.com/index.php/auth/oauth/".$provider->name;
		// Add the callback URL to the consumer
            $consumer->callback($callback); 

            // Get a request token for the consumer
            $token = $provider->request_token($consumer);
            // Store the token
            $this->session->set_userdata($provider_name.'_oauth_token', base64_encode(serialize($token)));

            // Get the URL to the twitter login page
            $url = $provider->authorize($token, array(
                'oauth_callback' => $callback,
            ));

            // Send the user off to login
            redirect($url);
        }
        else
        {
            if ($this->session->userdata($provider_name.'_oauth_token'))
            {
                // Get the token from storage
                $token = unserialize(base64_decode($this->session->userdata($provider_name.'_oauth_token')));
            }

            if ( ! empty($token) AND $token->access_token !== $this->input->get_post('oauth_token'))
            {   
                // Delete the token, it is not valid
                $this->session->unset_userdata($provider_name.'_oauth_token');

                // Send the user back to the beginning
                exit('invalid token after coming back to site');
            }

            // Get the verifier
            $verifier = $this->input->get_post('oauth_verifier');

            // Store the verifier in the token
            $token->verifier($verifier);

            // Exchange the request token for an access token
            $token = $provider->access_token($consumer, $token);

            // We got the token, let's get some user data
            $user = $provider->get_user_info($consumer, $token);

            // Here you should use this information to A) look for a user B) help a new user sign up with existing data.
            // If you store it all in a cookie and redirect to a registration page this is crazy-simple.
            /*echo "<pre>Tokens: ";
            var_dump($token).PHP_EOL.PHP_EOL;

            echo "User Info: ";
            var_dump($user);
			*/
			if(!isset($user['name']))
			{
				redirect("http://dgtldiary.phpfogapp.com/");
			}
			
			if($provider->name == "flickr")
			{
				$meta = $this->Data_model->get_user_emeta($this->session->userdata('$user_email'));
				if($meta != "")
				{
					
					$unsermeta = unserialize($meta);
					if(isset($unsermeta['flickr']))
					{
						
						
					}
					else
					{
						$unsermeta['flickr'] = $user["uid"];
						$this->Data_model->update_user_meta($this->session->userdata('$user_email'), serialize($unsermeta));
						$user_photo = $provider->get_user_photo($consumer, $token,$user["uid"], $this->config->item($provider->name.'_key'));
						//echo "User Photo Info: ";
						//print_r($user_photo);
						$user_id = $this->Data_model->get_userid($this->session->userdata('$user_email'));
						foreach($user_photo['photos']['photo'] as $photo)
						{
							$photo_data = $provider->get_photo_info($consumer, $token, $this->config->item($provider->name.'_key'), $photo['id']);
							//print_r($photo_data);
							$pagedata['media'] = "http://farm".$photo['farm'].'.staticflickr.com/'.$photo['server'].'/'.$photo['id'].'_'.$photo['secret'].'_m.jpg';
							$pagedata['user_id'] = $user_id;
							$pagedata['startdate'] = $photo_data['photo']['dates']['taken'];
							$pagedata['headline'] = $photo_data['photo']['title']['_content'];
							$pagedata['text'] = $photo_data['photo']['description']['_content'];
							$this->Data_model->post_user_page($pagedata);
						}

					}
				}
				else
				{
					$unsermeta['flickr'] = $user["uid"];
					$this->Data_model->create_user($this->session->userdata('$user_email'), serialize($unsermeta));

					$user_photo = $provider->get_user_photo($consumer, $token,$user["uid"], $this->config->item($provider->name.'_key'));
					//echo "User Photo Info: ";
					//print_r($user_photo);
					$user_id = $this->Data_model->get_userid($this->session->userdata('$user_email'));
					foreach($user_photo['photos']['photo'] as $photo)
					{
						$photo_data = $provider->get_photo_info($consumer, $token, $this->config->item($provider->name.'_key'), $photo['id']);
						//print_r($photo_data);
						$pagedata['media'] = "http://farm".$photo['farm'].'.staticflickr.com/'.$photo['server'].'/'.$photo['id'].'_'.$photo['secret'].'_m.jpg';
						$pagedata['user_id'] = $user_id;
						$pagedata['startdate'] = $photo_data['photo']['dates']['taken'];
						$pagedata['headline'] = $photo_data['photo']['title']['_content'];
						$pagedata['text'] = $photo_data['photo']['description']['_content'];
						$this->Data_model->post_user_page($pagedata);
					}
					
				}
				
				
				
				$user_id = $this->Data_model->get_userid($this->session->userdata('$user_email'));
				$pages = $this->Data_model->get_user_page($user_id);
				$data['pagejson'] ="";
				$data['emailmd5']=md5( strtolower( trim( $this->session->userdata('$user_email') ) ) );
				foreach ($pages as $page)
				{
					if("" == $data['pagejson'])
					{
					
					}
					else
					{
						$data['pagejson'] = $data['pagejson'].',';
					}
					$timecalcdata = split('[- :]',$page['startdate']);
					$dateformatfinal = $timecalcdata[0].','.$timecalcdata[1].','.$timecalcdata[2].','.$timecalcdata[3].','.$timecalcdata[4].','.$timecalcdata[5];
							
					$data['pagejson'] = $data['pagejson'].'{"startDate":"'.$dateformatfinal.'","endDate":"'.$dateformatfinal.'","headline":"'.$page['headline'].'","text":"<p>'.$page['text'].'</p>","asset":{"media":"'.$page['media'].'","credit":"","caption":""}}';
				}
			if($this->session->userdata('$mobile')=="1")
			{
				$this->load->view('fatlast',$data);
			}
			else{
				$this->load->view('atlast',$data);
				}
			}
        }
    }
	
	
public function oauth2($provider,$useremail='',$mobile='')
{
if($provider == "instagram")
	{
		$this->load->model('Data_model');	
	require_once 'Instagram.php';
	
	$config = array(
        'client_id' => $this->config->item($provider.'_key'), // Your client id
        'client_secret' => $this->config->item($provider.'_secret'), // Your client secret
        'grant_type' => 'authorization_code',
        'redirect_uri' => 'http://dgtldiary.phpfogapp.com/index.php/auth/oauth2/instagram', // The redirect URI you provided when signed up for the service
     );
	
	 if ( ! $this->input->get('code'))
	 {
		if($useremail == '')
		{
	redirect("http://dgtldiary.phpfogapp.com/");	
		}
		if($mobile == "mobile")
			{$this->session->set_userdata('$mobile',"1");}
			
			$this->session->set_userdata('$user_email',$useremail);
			
		$instagram = new Instagram($config);
		$instagram->openAuthorizationUrl();
	 }
	 else
	 {
		$instagram = new Instagram($config);

		$accessToken = $instagram->getAccessToken();

		$instagram->setAccessToken($accessToken);
		$user=$instagram->getCurrentUser();
		$meta = $this->Data_model->get_user_emeta($this->session->userdata('$user_email'));
		
		if($meta != "")
		{
			
			$unsermeta = unserialize($meta);
			if(isset($unsermeta['instagram']))
			{
				
				
			}
			else
			{
				$unsermeta['instagram'] = $user->id;
				$this->Data_model->update_user_meta($this->session->userdata('$user_email'), serialize($unsermeta));
				$response = $instagram->getUserRecent($user->id);
				$requireddata = json_decode($response,true);
				$user_id = $this->Data_model->get_userid($this->session->userdata('$user_email'));
				foreach($requireddata['data'] as $page)
				{
					$pagedata['media'] = $page['images']['standard_resolution']['url'];
					$pagedata['user_id'] = $user_id;
					$pagedata['startdate'] =  date( 'Y-m-d H:i:s', $page['created_time'] );
					$pagedata['headline'] = $page['caption'] == "" ? "Headline" : $page['caption'] ;
					$pagedata['text'] = "Likes = ".$page['likes']['count'].'<section contenteditable=\"true\"><br/><h4>Comments </h4> <br/></section>';
					$this->Data_model->post_user_page($pagedata);
				}

			}
		}
		else
		{
			$unsermeta['instagram'] = $user->id;
			$this->Data_model->create_user($this->session->userdata('$user_email'), serialize($unsermeta));
			$response = $instagram->getUserRecent($user->id);
			$requireddata = json_decode($response,true);
			$user_id = $this->Data_model->get_userid($this->session->userdata('$user_email'));
			foreach($requireddata['data'] as $page)
			{
				$pagedata['media'] = $page['images']['standard_resolution']['url'];
				$pagedata['user_id'] = $user_id;
				$pagedata['startdate'] =  date( 'Y-m-d H:i:s', $page['created_time'] );
				$pagedata['headline'] = $page['caption'];
				$pagedata['text'] = "Likes = ".$page['likes']['count'].'<section contenteditable=\"true\"><br/><h4>Comments </h4> <br/></section>';
				$this->Data_model->post_user_page($pagedata);
			}
		}
		
		$user_id = $this->Data_model->get_userid($this->session->userdata('$user_email'));
		
		$pages = $this->Data_model->get_user_page($user_id);
		$data['pagejson'] ="";
		$data['emailmd5']=md5( strtolower( trim( $this->session->userdata('$user_email') ) ) );
	
		foreach ($pages as $page)
		{
			if("" == $data['pagejson'])
			{
			
			}
			else
			{
				$data['pagejson'] = $data['pagejson'].',';
			}
			$timecalcdata = split('[- :]',$page['startdate']);
			$dateformatfinal = $timecalcdata[0].','.$timecalcdata[1].','.$timecalcdata[2].','.$timecalcdata[3].','.$timecalcdata[4].','.$timecalcdata[5];
				$dateformatfinal = "2012,09,11";	
			$data['pagejson'] = $data['pagejson'].'{"startDate":"'.$dateformatfinal.'","endDate":"'.$dateformatfinal.'","headline":"'.$page['headline'].'","text":"<p>'.$page['text'].'</p>","asset":{"media":"'.$page['media'].'","credit":"","caption":""}}';
		}
		
		
		if($this->session->userdata('$mobile')=="1")
		{
			$this->load->view('fatlast',$data);
		}
		else
		{

		//echo "DDDDDD".$this->session->userdata('$mobile');
			$this->load->view('atlast',$data);
		}
		
		
		
		}

	 }
	}
}

