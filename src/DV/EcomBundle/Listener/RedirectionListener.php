<?php
namespace DV\EcomBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class RedirectionListener
{
	public function __construct(ContainerInterface $container, Session $session)
	{
		$this->session = $session;
		$this->router = $container->get('router');
		$this->securityContext = $container->get('security.context');//$this->securityContext = $container->get('security.context'); = $container->get('security.token_storage');
	}

	public function onKernelRequest(GetResponseEvent $event)
	{
		$route = $event->getRequest()->attributes->get('_route'); //récupère la route courrante
		if ($route == 'livraison' || $route == 'validation') 
		{
			//on sécurise l'accès aux pages par l'URL :
			if($this->session->has('panier'))
			{
				if(count($this->session->get('panier')) == 0)
					$event->setResponse(new RedirectResponse($this->router->generate('panier')));
			}
		

			if (!is_object($this->securityContext->getToken()->getUser()))
			{
				//On récupère l'utilisateur courant, et si ce n'est pas un objet, c'est qu'il n'est pas connecté...
				$this->session->getFlashBag()->add('notification', 'Vous devez vous identifier');
				$event->setResponse(new RedirectResponse($this->router->generate('fos_user_security_login')));
			}
		}
	}
}