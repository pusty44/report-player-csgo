<?php
/**
 * Created by PhpStorm.
 * User: pusty
 * Date: 13.08.2018
 * Time: 11:24
 */

namespace App\Repository;
use App\Entity\BlogArticleEntity;
use App\Entity\BlogCategoriesEntity;
use Doctrine\DBAL\ParameterType;
use Doctrine\ORM\EntityRepository;
use Exception;
use PDO;

class BlogArticlesRepository extends EntityRepository
{
    /**
     * @return Integer
     */
    public function countArticles() :String{
        $result = -1;
        try {
            $newsarr = array();
            $conn = $this->getEntityManager()->getConnection();
            $sql = 'SELECT count(*) as counter FROM www_blog';
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            $result = $results[0]['counter'];
        } catch(Exception $e){
            echo $e->getMessage();
        }
        return $result;
    }

    public function countPerDay($limit) :array {
        $results = false;
        try {
            $conn = $this->getEntityManager()->getConnection();
            $sql = 'SELECT  DATE(date) Date, COUNT(*) counter FROM www_blog GROUP BY DATE(date) ORDER BY date DESC LIMIT :limit';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':limit',$limit, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll();
        } catch(Exception $e){
            echo $e->getMessage();
        }
        return $results;

    }

    public function countPerCategory() :array {
        $results = false;
        try {
            $conn = $this->getEntityManager()->getConnection();
            $sql = 'SELECT count(www_blog.title) as counter, www_blogCategories.title as title from www_blog INNER JOIN www_blogCategories ON www_blog.category=www_blogCategories.id GROUP BY www_blog.category;';
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
        } catch(Exception $e){
            echo $e->getMessage();
        }
        return $results;

    }
    public function paginateNews ( int $limit, int $page) :array{
        $results = false;
        try {
            $newsarr = array();
            $offset = $limit*$page-$limit;
            $conn = $this->getEntityManager()->getConnection();
            $sql = 'SELECT www_blog.title as title, www_blog.date as date, www_blog.seo_url as seo_url,www_blogCategories.title as category FROM www_blog INNER JOIN www_blogCategories ON www_blog.category=www_blogCategories.id ORDER BY date DESC LIMIT :limit OFFSET :offset';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':limit',$limit,ParameterType::INTEGER);
            $stmt->bindParam(':offset',$offset,ParameterType::INTEGER);
            $stmt->execute();

            $results = $stmt->fetchAll();
            return $results;
        } catch(Exception $e){
            echo $e->getMessage();
            return [
                'error' => 404
            ];
        }

    }

    public function paginate(int $limit, int $page){
        $newsarr = array();
        $url = '/blog/article/list/';
        $offset = $limit*$page-$limit;
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT count(*) as counter FROM www_blog';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cat',$cat,ParameterType::INTEGER);

        $stmt->execute();

        $result = $stmt->fetch();
        $pages = round($result['counter']/$limit,0);
        if($pages < $result['counter']) $pages++;
        $pagearr = array();
        if($pages > 10){
            for($i=$page;$i<=$page+3;$i++){
                $pagearr[] = [
                    'url' => $url.$i,
                    'number' => $i
                ];
            }
            $pagearr[] =[
                'url' => '#',
                'number'=>'...'
            ];
            for($i=$pages-3;$i<=$pages;$i++){
                $pagearr[] = [
                    'url' => $url.$i,
                    'number' => $i
                ];
            }
        } else {
            for($i=1;$i<=$pages;$i++){
                $pagearr[] = [
                    'url' => $url.$i,
                    'number' => $i
                ];
            }
        }
        $back = $page-1;
        if($page < $pages) $next = $page+1;
        else $next = $pages;
        return [
            'first' => $url.$back,
            'current' => $page,
            'page' => $pagearr,
            'last' => $next,
        ];
    }
}