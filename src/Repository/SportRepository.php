<?php

namespace App\Repository;

use App\Entity\Sport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sport[]    findAll()
 * @method Sport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SportRepository extends ServiceEntityRepository
{
    private $entity = 'App\Entity\Sport';

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sport::class);
    }

    public function findAllSortBy($sortBy = 'id', $sortOrder = 'desc') // par defaut on trie par id par ordre décroissant
    {
        $qb = $this->getEntityManager()->createQueryBuilder(); // Instanciation de la QueryBuilder
        $qb->select('entity')->from($this->entity, 'entity');  // SELECT FROM, basic simple

        // en fonction de ce avec quoi on trie 
        switch ($sortBy)
        {
            default:
                $qb->orderBy('entity.'.$sortBy, $sortOrder); // On effectue le trie
                break;
        }
        return $qb; // On renvoie la QueryBuilder
    }

    /**
     * Prend en paramètre:
     *  la QueryBuilder instancié
     *  un array qui contient toutes les valeurs envoyés dans l'url
     *  where qui contient ou le filtrage s'execute
     * 
     * EXEMPLE : je veux récuperer tout les tests dont l'age est 16 ou 17
     *  array = 16,17
     *  where = 'entity.age'
     */
    public function filterWith($qb, $array, $where) 
    {
        // Tri selon un nom du sport .
        // Il n'est pas obligé de recevoir le nom entier ou exacte du sport pour le chercher
        // (recherche comme sur le moteur google lorsque on tape ce que l'on cherche)

        $qb->where('entity.name LIKE :name')->setParameter('name', $array.'%'); 

        return $qb;
    }


    /**
     * Ici on définit le maximum de resultat retourné ainsi que la pagination
     * 
     * Exemple : on a 100 Test, mais on ne veut qu'en afficher 20 par 20
     *  limit=20
     *  ce qui fait qu'au maximum on a 5 pages :
     *    page=1 (= les 20 premiers resultats)
     *    page=2 (= les 20 suivants resultats)
     *    page=3 (= les 20 suivants resultats)
     *    ect, ... 
     */
    public function pageLimit($qb, $page, $limit)
    {
        $qb->setFirstResult(($page-1) * $limit);

        if ($limit > 100)
            $limit = 100;
    
        $qb->setMaxResults($limit);

        return $qb;
    }








    // /**
    //  * @return Sport[] Returns an array of Sport objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sport
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
