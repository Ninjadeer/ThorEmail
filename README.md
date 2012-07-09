
### Usage example - Simple

			<?php
			
			// Create message
			$message = new Message();
			$message->setTo('Recipient Name, 'email@domain.tld');
			$message->setSubject('Subject');

			$this->thorEmail()->send($message);	

### Usage example - With view model and template

			<?php
			
			// Create message
			$message = new Message();
			$message->setTo('Recipient Name, 'email@domain.tld');
			$message->setSubject('Subject');
			
			$vars = array(
				'foo' => 'bar'
			);
			
			// Create viewModel and set template
			$viewModel = new \Zend\View\Model\ViewModel($vars);
			$viewModel->setTemplate('path\to\template');

			// Send the message with additional $viewModel argument
			$this->thorEmail()->send($message, viewModel);	

### Usage example - With view model and template and layout

			<?php
			
			// Create message
			$message = new Message();
			$message->setTo('Recipient Name, 'email@domain.tld');
			$message->setSubject('Subject');
			
			// Create viewModel and set template
			$viewModel = new ViewModel(array('accountModel' => $accountModel, 'accountTokenModel'=>$accountTokenModel));
			$viewModel->setTemplate('path\to\template');
			
			// Create layout viewModel and set template
			$layoutViewModel =  new ViewModel(array('accountModel' => $accountModel, 'accountTokenModel'=>$accountTokenModel));
			$viewModel->setTemplate('path\to\layout-template');
			
			// Set layout
			$this->thorEmail()->setLayout($layoutViewModel);

			// Send the message with additional $viewModel argument
			$this->thorEmail()->send($message, viewModel);