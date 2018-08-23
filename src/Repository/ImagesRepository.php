<?php
/**
 * Created by PhpStorm.
 * User: pusty
 * Date: 13.08.2018
 * Time: 11:42
 */

namespace App\Repository;
use Doctrine\DBAL\ParameterType;
use Doctrine\ORM\EntityRepository;
use Exception;

class ImagesRepository extends EntityRepository
{
    /**
     * @return Integer
     */
    public function countImages() :String{
        $result = -1;
        try {
            $conn = $this->getEntityManager()->getConnection();
            $sql = 'SELECT count(*) as counter FROM www_image';
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