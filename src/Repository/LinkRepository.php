<?php

namespace OSJ\Repository;

class LinkRepository extends Repository
{
    public function getByURL($url)
    {
        $sql = "SELECT * FROM osj_links
                WHERE url = :url";
        $prepare = $this->conn->prepare($sql);
        $prepare->execute([
            "url" => $url
        ]);
        $result = $prepare->fetch(\PDO::FETCH_ASSOC) ?: [];
        return $result;
    }

    public function getByToken($token)
    {
        $sql = "SELECT * FROM osj_links
                WHERE token = :token";
        $prepare = $this->conn->prepare($sql);
        $prepare->execute([
            "token" => $token
        ]);
        $result = $prepare->fetch(\PDO::FETCH_ASSOC) ?: [];
        return $result;
    }

    public function createLink($token, $url)
    {
        $sql = "INSERT INTO osj_links
                (`token`, `url`)
                VALUES (:token, :url)";
        $prepare = $this->conn->prepare($sql);
        $prepare->execute([
            "token" => $token,
            "url"   => $url
        ]);
    }
}

/*

CREATE TABLE osj_links (
	id INT NOT NULL AUTO_INCREMENT,
    token VARCHAR(8) NOT NULL,
	url VARCHAR(512) NOT NULL,
	created DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
)

*/