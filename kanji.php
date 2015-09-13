<?php 
header('Content-Type: text/html; charset=utf-8');

			$data = file_get_contents('data/jlptn5.json');
			$data = @json_decode($data);

			echo '<ol>';
			foreach($data as $row){
				echo '<li><dl>';
				foreach($row as $key=>$val){
					if($key=='category'){ continue; }
					echo '<dt>'.$key.'</dt>';
					echo '<dd>'.$val.'</dd>';
				}
				echo '</dl></li>';
			}
			echo '</ol>';

		?>