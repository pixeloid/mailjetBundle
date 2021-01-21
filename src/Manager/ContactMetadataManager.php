<?php

namespace Mailjet\MailjetBundle\Manager;

use \Mailjet\Response;
use \Mailjet\Resources;

use Mailjet\MailjetBundle\Client\MailjetClient;
use Mailjet\MailjetBundle\Exception\MailjetException;
use Mailjet\MailjetBundle\Model\ContactMetadata;

/**
* https://dev.mailjet.com/email-api/v3/contactmetadata/
* manage ContactsMetadata (create, update, delete, ...)
*
*/
class ContactMetadataManager
{
    /**
     * Mailjet client
     * @var MailjetClient
     */
    protected $mailjet;

    /**
     * @param MailjetClient $mailjet
     */
    public function __construct(MailjetClient $mailjet)
    {
        $this->mailjet = $mailjet;
    }

    /**
     * Retrieve all ContactMetadata
     * @return array
     */
    public function getAll()
    {
        $response = $this->mailjet->get(Resources::$Contactmetadata);
        if (!$response->success()) {
            $this->throwError("ContactMetadataManager:getAll() failed", $response);
        }

        return $response->getData();
    }

    /**
     * Retrieve one ContactMetadata
     * @param string $id
     * @return array
     */
    public function get($id)
    {
        $response = $this->mailjet->get(Resources::$Contactmetadata, ['id' => $id]);
        if (!$response->success()) {
            $this->throwError("ContactMetadataManager:get() failed", $response);
        }

        return $response->getData();
    }

    /**
     * create a new fresh ContactMetadata
     * @param ContactMetadata $contactMetadata
     */
    public function create(ContactMetadata $contactMetadata)
    {
        $response = $this->mailjet->post(Resources::$Contactmetadata, ['body' => $contactMetadata->format()]);
        if (!$response->success()) {
            $this->throwError("ContactMetadataManager:create() failed", $response);
        }

        return $response->getData();
    }

    /**
     * Update one ContactMetadata
     * @param int $id
     * @param ContactMetadata $contactMetadata
     */
    public function update($id, ContactMetadata $contactMetadata)
    {
        $response = $this->mailjet->put(Resources::$Contactmetadata, ['id' => $id,'body' => $contactMetadata->format()]);
        if (!$response->success()) {
            $this->throwError("ContactMetadataManager:update() failed", $response);
        }

        return $response->getData();
    }

    /**
     * Delete one ContactMetadata
     * @param int $id
     */
    public function delete($id)
    {
        $response = $this->mailjet->delete(Resources::$Contactmetadata, ['id' => $id]);
        if (!$response->success()) {
            $this->throwError("ContactMetadataManager:delete() failed", $response);
        }

        return $response->getData();
    }

    /**
     * Helper to throw error
     * @param  string $title
     * @param  Response $response
     */
    private function throwError($title, Response $response)
    {
        throw new MailjetException(0, $title, $response);
    }
}
