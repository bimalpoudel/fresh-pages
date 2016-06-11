<?php
class fresh_pages
{
	private $url = 'https://raw.githubusercontent.com/bimalpoudel/fresh-pages/master/pages';
	private $pages = array();
	private $whoami = null;

	public function init($whoami='fresh-pages/fresh-pages.php')
	{
		$this->whoami=$whoami;

		register_activation_hook($this->whoami, array($this, 'install'));
		register_deactivation_hook($this->whoami, array($this, 'uninstall'));
	}

	public function install()
	{
		$this->pages = array(
			'about-us' => array(
				'post_title' => 'About Us',
				'content_url' => 'about-us.md',
				'post_type' => 'page',
				'post_category' => array(1), # Uncategorised
			),
			'contact-us' => array(
				'post_title' => 'Contact Us',
				'content_url' => 'contact-us.md',
				'post_type' => 'page',
				'post_category' => array(1), # Uncategorised
			),
			'error' => array(
				'post_title' => 'Error',
				'content_url' => 'error.md',
				'post_type' => 'page',
				'post_category' => array(1), # Uncategorised
			),
			'frequently-asked-questions' => array(
				'post_title' => 'Frequently Asked Questions',
				'content_url' => 'frequently-asked-questions.md',
				'post_type' => 'page',
				'post_category' => array(1), # Uncategorised
			),
			'help' => array(
				'post_title' => 'Help',
				'content_url' => 'help.md',
				'post_type' => 'page',
				'post_category' => array(1), # Uncategorised
			),
			'privacy-policy' => array(
				'post_title' => 'Privacy Policy',
				'content_url' => 'privacy-policy.md',
				'post_type' => 'page',
				'post_category' => array(1), # Uncategorised
			),
			'terms-and-conditions' => array(
				'post_title' => 'Terms and Conditions',
				'content_url' => 'terms-and-conditions.md',
				'post_type' => 'page',
				'post_category' => array(1), # Uncategorised
			),
			'thank-you' => array(
				'post_title' => 'Thank You',
				'content_url' => 'thank-you.md',
				'post_type' => 'page',
				'post_category' => array(1), # Uncategorised
			),
			'welcome' => array(
				'post_title' => 'Welcome',
				'content_url' => 'welcome.md',
				'post_type' => 'page',
				'post_category' => array(1), # Uncategorised
			),
		);

		foreach($this->pages as $post_name => $page)
		{
			#print_r($page); continue;
			
			$the_page = get_page_by_path( $post_name );
			if (!$the_page) {
				$page['post_name'] = $post_name;
				$page['post_status'] = 'publish';
				$page['comment_status'] = 'closed';
				$page['ping_status'] = 'closed';
				
				$page['post_content'] = wp_remote_fopen($this->url.'/'.$page['content_url']);
				unset($page['content_url']);
				#print_r($page);

				$the_page_id = wp_insert_post($page);
			}
			else
			{
				#print_r($the_page);
				$the_page_id = $the_page->ID;
				$the_page->post_status = 'publish';
				
				#$page['post_content'] = wp_remote_fopen($this->url.'/'.$page['content_url']);
				
				$the_page_id = wp_update_post( $the_page );
			}
		}
		#die();
	}

	public function uninstall()
	{
		foreach($this->pages as $post_name => $page)
		{
			$the_page = get_page_by_name( $post_name );
			if ( $the_page ) {
				#print_r($the_page);
				#wp_delete_post( $the_page->ID );
				// this will trash, not delete
			}
		}
		#die();
	}
}
