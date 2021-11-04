<?php
namespace testApplication;

class View
{
    protected $hash;
    protected $ipAddress;
    protected $userAgent;
    protected $viewDate;
    protected $pageUrl;
    protected $db;

    public function __construct($ipAddress, $userAgent, $viewDate, $pageUrl, $db)
    {
        $this->hash = sha1($ipAddress . $userAgent . $pageUrl);
        $this->ipAddress = $ipAddress;
        $this->userAgent = $userAgent;
        $this->viewDate = $viewDate;
        $this->pageUrl = $pageUrl;
        $this->db = $db;
    }

    /*
     * Record user data into db
     * */
    public function hit()
    {
        $sql = "INSERT INTO `views` (
                 `hash`, 
                 `ip_address`, 
                 `user_agent`, 
                 `view_date`, 
                 `page_url`
             ) VALUES (
                :hash,
                :ip_address,
                :user_agent,
                :view_date,
                :page_url
             )
             ON DUPLICATE KEY UPDATE `views_count` = `views_count` + 1, `view_date` = now()
        ";

        $res = $this->db->prepare($sql);
        $res->execute([
            'hash' => $this->hash,
            'ip_address' => $this->ipAddress,
            'user_agent' => $this->userAgent,
            'view_date' => $this->viewDate,
            'page_url' => $this->pageUrl
        ]);

        if ($res)
            return true;

        return false;
    }
}