<?php
/**
 * Created by PhpStorm.
 * User: pusty
 * Date: 13.08.2018
 * Time: 11:45
 */

namespace App\Repository;
use Doctrine\DBAL\ParameterType;
use Doctrine\ORM\EntityRepository;
use Exception;

class PagesRepository extends EntityRepository
{
    /**
     * @return Integer
     */
    public function countPages() :String{
        $result = -1;
        try {
            $newsarr = array();
            $conn = $this->getEntityManager()->getConnection();
            $sql = 'SELECT count(*) as counter FROM www_pages';
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            $result = $results[0]['counter'];
        } catch(Exception $e){
            echo $e->getMessage();
        }
        return $result;
    }
}