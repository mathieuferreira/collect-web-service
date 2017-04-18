<?php
/**
 * Created by PhpStorm.
 * User: mathieuferreira
 * Date: 16/04/17
 * Time: 15:16
 */

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Data {

    #region Const

    const HITTYPE_PAGEVIEW = 'pageview';
    const HITTYPE_SCREENVIEW = 'screenview';
    const HITTYPE_EVENT = 'event';

    const CREATORTYPE_PROFILE = 'profile';
    const CREATORTYPE_RECRUITER = 'recruiter';
    const CREATORTYPE_VISITOR = 'visitor';
    const CREATORTYPE_EMPLOYEE = 'wizbii_employee';

    const DATASOURCE_WEB = 'web';
    const DATASOURCE_APPS = 'apps';
    const DATASOURCE_BACKEND = 'backend';

    #endregion
    
    #region Public Properties

    public static $hitTypes = [
        self::HITTYPE_PAGEVIEW,
        self::HITTYPE_SCREENVIEW,
        self::HITTYPE_EVENT,
    ];

    public static $creatorTypes = [
        self::CREATORTYPE_PROFILE,
        self::CREATORTYPE_RECRUITER,
        self::CREATORTYPE_VISITOR,
        self::CREATORTYPE_EMPLOYEE,
    ];

    public static $dataSources = [
        self::DATASOURCE_WEB,
        self::DATASOURCE_APPS,
        self::DATASOURCE_BACKEND,
    ];

    #endregion
    
    #region Protected Properties

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $version;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $hitType;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $documentLocation;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $documentReferer;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $creatorType;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $userId;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $uniqUserId;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $eventCategory;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $eventAction;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $eventLabel;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $eventValue;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $trackingId;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $dataSource;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $campaignName;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $campaignSource;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $campaignMedium;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $campaignKeyword;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $campaignContent;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $screenName;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $applicationName;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $applicationVersion;

    /**
     * @MongoDB\Field(type="timestamp")
     */
    protected $collectDate;

    #endregion
    
    #region Private Properties
    #endregion
    
    #region Magic methods
    #endregion
    
    #region Getters/Setters

    /** @return mixed */
    public function getId()
    {
        return $this->id;
    }

    /** @return mixed */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     * @return Data
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /** @return mixed */
    public function getHitType()
    {
        return $this->hitType;
    }

    /**
     * @param mixed $hitType
     * @return Data
     */
    public function setHitType($hitType)
    {
        $this->hitType = $hitType;
        return $this;
    }

    /** @return mixed */
    public function getDocumentLocation()
    {
        return $this->documentLocation;
    }

    /**
     * @param mixed $documentLocation
     * @return Data
     */
    public function setDocumentLocation($documentLocation)
    {
        $this->documentLocation = $documentLocation;
        return $this;
    }

    /** @return mixed */
    public function getDocumentReferer()
    {
        return $this->documentReferer;
    }

    /**
     * @param mixed $documentReferer
     * @return Data
     */
    public function setDocumentReferer($documentReferer)
    {
        $this->documentReferer = $documentReferer;
        return $this;
    }

    /** @return mixed */
    public function getCreatorType()
    {
        return $this->creatorType;
    }

    /**
     * @param mixed $creatorType
     * @return Data
     */
    public function setCreatorType($creatorType)
    {
        $this->creatorType = $creatorType;
        return $this;
    }

    /** @return mixed */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     * @return Data
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /** @return mixed */
    public function getUniqUserId()
    {
        return $this->uniqUserId;
    }

    /**
     * @param mixed $uniqUserId
     * @return Data
     */
    public function setUniqUserId($uniqUserId)
    {
        $this->uniqUserId = $uniqUserId;
        return $this;
    }

    /** @return mixed */
    public function getEventCategory()
    {
        return $this->eventCategory;
    }

    /**
     * @param mixed $eventCategory
     * @return Data
     */
    public function setEventCategory($eventCategory)
    {
        $this->eventCategory = $eventCategory;
        return $this;
    }

    /** @return mixed */
    public function getEventAction()
    {
        return $this->eventAction;
    }

    /**
     * @param mixed $eventAction
     * @return Data
     */
    public function setEventAction($eventAction)
    {
        $this->eventAction = $eventAction;
        return $this;
    }

    /** @return mixed */
    public function getEventLabel()
    {
        return $this->eventLabel;
    }

    /**
     * @param mixed $eventLabel
     * @return Data
     */
    public function setEventLabel($eventLabel)
    {
        $this->eventLabel = $eventLabel;
        return $this;
    }

    /** @return mixed */
    public function getEventValue()
    {
        return $this->eventValue;
    }

    /**
     * @param mixed $eventValue
     * @return Data
     */
    public function setEventValue($eventValue)
    {
        $this->eventValue = $eventValue;
        return $this;
    }

    /** @return mixed */
    public function getTrackingId()
    {
        return $this->trackingId;
    }

    /**
     * @param mixed $trackingId
     * @return Data
     */
    public function setTrackingId($trackingId)
    {
        $this->trackingId = $trackingId;
        return $this;
    }

    /** @return mixed */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * @param mixed $dataSource
     * @return Data
     */
    public function setDataSource($dataSource)
    {
        $this->dataSource = $dataSource;
        return $this;
    }

    /** @return mixed */
    public function getCampaignName()
    {
        return $this->campaignName;
    }

    /**
     * @param mixed $campaignName
     * @return Data
     */
    public function setCampaignName($campaignName)
    {
        $this->campaignName = $campaignName;
        return $this;
    }

    /** @return mixed */
    public function getCampaignSource()
    {
        return $this->campaignSource;
    }

    /**
     * @param mixed $campaignSource
     * @return Data
     */
    public function setCampaignSource($campaignSource)
    {
        $this->campaignSource = $campaignSource;
        return $this;
    }

    /** @return mixed */
    public function getCampaignMedium()
    {
        return $this->campaignMedium;
    }

    /**
     * @param mixed $campaignMedium
     * @return Data
     */
    public function setCampaignMedium($campaignMedium)
    {
        $this->campaignMedium = $campaignMedium;
        return $this;
    }

    /** @return mixed */
    public function getCampaignKeyword()
    {
        return $this->campaignKeyword;
    }

    /**
     * @param mixed $campaignKeyword
     * @return Data
     */
    public function setCampaignKeyword($campaignKeyword)
    {
        $this->campaignKeyword = $campaignKeyword;
        return $this;
    }

    /** @return mixed */
    public function getCampaignContent()
    {
        return $this->campaignContent;
    }

    /**
     * @param mixed $campaignContent
     * @return Data
     */
    public function setCampaignContent($campaignContent)
    {
        $this->campaignContent = $campaignContent;
        return $this;
    }

    /** @return mixed */
    public function getScreenName()
    {
        return $this->screenName;
    }

    /**
     * @param mixed $screenName
     * @return Data
     */
    public function setScreenName($screenName)
    {
        $this->screenName = $screenName;
        return $this;
    }

    /** @return mixed */
    public function getApplicationName()
    {
        return $this->applicationName;
    }

    /**
     * @param mixed $applicationName
     * @return Data
     */
    public function setApplicationName($applicationName)
    {
        $this->applicationName = $applicationName;
        return $this;
    }

    /** @return mixed */
    public function getApplicationVersion()
    {
        return $this->applicationVersion;
    }

    /**
     * @param mixed $applicationVersion
     * @return Data
     */
    public function setApplicationVersion($applicationVersion)
    {
        $this->applicationVersion = $applicationVersion;
        return $this;
    }

    /** @return mixed */
    public function getCollectDate()
    {
        return $this->collectDate;
    }

    /**
     * @param mixed $collectDate
     * @return Data
     */
    public function setCollectDate($collectDate)
    {
        $this->collectDate = $collectDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getQueueTime(){
        if($this->collectDate === NULL)
            return 0;

        return time() - $this->collectDate;
    }

    /**
     * @param int $queueTime
     * @return Data
     */
    public function setQueueTime($queueTime){
        $this->collectDate = time() - $queueTime;
        return $this;
    }

    #endregion
    
    #region Public methods
    #endregion
    
    #region Protected methods
    #endregion
    
    #region Private methods
    #endregion
}