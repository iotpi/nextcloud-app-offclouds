<?php
namespace OCA\OffClouds\Controller;

use OCP\IRequest;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\ContentSecurityPolicy;
use OCP\AppFramework\Controller;

class PageController extends Controller {
	private $userId;

	public function __construct($AppName, IRequest $request, $UserId){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
	}

	/**
	 * CAUTION: the @Stuff turns off security checks; for this page no admin is
	 *          required and no CSRF check. If you don't know what CSRF is, read
	 *          it up in the docs or you might create a security hole. This is
	 *          basically the only required method to add this exemption, don't
	 *          add it to any other method if you don't exactly know what it does
	 *
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function index() {
        // https://doc.owncloud.org/server/10.5/developer_manual/app/fundamentals/controllers.html
        $csp = new ContentSecurityPolicy();
        $csp->addAllowedConnectDomain("ws://127.0.0.1:8080/graphql");
        
		$response = new TemplateResponse('offclouds', 'index');  // templates/index.php
        $response->setContentSecurityPolicy($csp);
        return $response;
	}

}
