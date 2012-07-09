<?php

namespace ThorEmail\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class ThorEmail extends AbstractPlugin
{

	/**
	 * @var \Zend\Mail\Transport\TransportInterface $mailTransport
	 */
	protected $mailTransport;

	/**
	 * @var \Zend\View\Model\ViewModel
	 */
	protected $layout;

	/**
	 * @var \Zend\View\Renderer\PhpRenderer
	 */
	protected $renderer;

    /**
     * @param \Zend\Mail\Message $message
     * @param \Zend\View\Model $viewModel
     */
    public function send(\Zend\Mail\Message $message, \Zend\View\Model\ViewModel $bodyViewModel = null) {

    	// If a view model is provided, then render this.
    	if (null !== $bodyViewModel) {
    		// Provide body to the template
    		$bodyViewModel->setVariable('body', $message->getBody());

    		// Render the template
    		$body = $this->renderer->render($bodyViewModel);

    		$message->setBody($body);
    	}

    	// If a view model is provided for the layout then render this also
    	if (null !== $this->layout) {
    		$layoutViewModel = $this->layout;

    		// Provide the body to the template
    		$layoutViewModel->setVariable('body', $message->getBody());

    		// Render the template
    		$body = $this->renderer->render($layoutViewModel);

    		$message->setBody($body);
    	}

    	// Get the mail transport and send the email
    	$mailTransport = $this->getMailTransport();

    	$mailTransport->send($message);
    }

	/**
	 * @return \Zend\Mail\Transport\TransportInterface
	 */
	public function getMailTransport()
	{
	    return $this->mailTransport;
	}

	/**
	 * @param \Zend\Mail\Transport\TransportInterface $mailTransport
	 */
	public function setMailTransport(\Zend\Mail\Transport\TransportInterface $mailTransport)
	{
	    $this->mailTransport = $mailTransport;
	}

	/**
	 * @return \Zend\View\Model\ViewModel
	 */
	public function getLayout()
	{
	    return $this->layout;
	}

	/**
	 * @param string|\Zend\View\Model\ViewModel $layout
	 * @throws Exception\InvalidArgumentException
	 */
	public function setLayout($layout)
	{
		if (is_string($layout)) {
			$layout = new \Zend\View\Model\ViewModel();
			$layout->setTemplate($layout);
		}

		if (!($layout instanceof \Zend\View\Model\ViewModel)) {
			throw new Exception\InvalidArgumentException(sprintf(
				'%s expects a string or instance of \Zend\View\Model\ViewModel argument; received "%s"',
				__METHOD__,
				gettype($layout)
			));
		}

		$this->layout = $layout;
	}

	/**
	 * @return \Zend\View\Renderer\PhpRenderer
	 */
	public function getRenderer()
	{
	    return $this->renderer;
	}

	/**
	 * @param \Zend\View\Renderer\PhpRenderer $renderer
	 */
	public function setRenderer(\Zend\View\Renderer\PhpRenderer $renderer)
	{
	    $this->renderer = $renderer;
	}
}