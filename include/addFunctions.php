<?php


	function addsParsing($count = 2, $url = 'http://darbo.lt/darbas/')
    {

							$options = get_option(RSSFEED);

					
					$addCount = 2;
					if ($options['count'] !=null) $addCount = $options['count'];
					if ($options['url'] !=null) $url = $options['url'];

				$file = getAddFile($url);
					if (!file) return;
					
					        $internalErrors = libxml_use_internal_errors(true);

                    $doc2 = new \DOMDocument();
                    $doc2->loadHTML($file);
                    $doc2->saveHTML();

                   $xpath2 = new \DomXPath($doc2);
					


                $conten= $xpath2->query("//table/tbody/tr[position() <={$addCount}]");

                        $conte = [];

                                   if($conten->length > 0) {
                    
                 foreach($conten as $parent) {
                        $cont = [];
                        $cont['href'] = $xpath2->query(".//td[@class=\"cell3\"][1]/a/@href", $parent)->item(0)->nodeValue;
                        $cont['description'] = $xpath2->query(".//td[@class=\"cell2\"][2]", $parent)->item(0)->nodeValue;
                        $cont['title'] =  $xpath2->query(".//td[@class=\"cell3\"][1]", $parent)->item(0)->nodeValue;

						echo "<a href=\"{$cont['href']}\">{$cont['title']}</a>{$cont['description']}<br>";
                    array_push($conte, $cont);
                    }
                }
        libxml_use_internal_errors($internalErrors);

    }
	
     function getAddFile($url)
    {
            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_PROXYPORT, 80);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);


            $homepage = curl_exec($ch);
            $error = curl_error($ch); 

            curl_close($ch);

            return $homepage;

    }

    //rss settings panel
	function addSetings()
	{
			$options = get_option(RSSFEED);
		  if (!is_array($options)) {
			$options = array();
		  }
		  
		  
	    $widget_data = $_POST[RSSFEED];
		  if ($widget_data['count'] & $widget_data['url']) {
			$options['count'] = (int) $widget_data['count'];
			$options['url'] = esc_url_raw($widget_data['url'], 'http');
		 
			update_option(RSSFEED, $options);
		  }
		
		?>
<p>
  <label for="<?php echo RSSFEED;?>-count">
    Number of adds to show:
  </label>
  <input class="widefat"
    type="number" 
    name="<?php echo RSSFEED; ?>[count]" 
    id="<?php echo RSSFEED; ?>-count" 
    value="<?php echo $options['count']; ?>"
	/>
</p>
<p>
  <label for="<?php echo RSSFEED;?>-url">
    darbo.lt sub Url to retrieve:
  </label>
  <input class="widefat"
    type="url"
    name="<?php echo RSSFEED; ?>[url]" 
    id="<?php echo RSSFEED; ?>-url" 
    value="<?php echo $options['url']; ?>"
</p>
<?php
	}