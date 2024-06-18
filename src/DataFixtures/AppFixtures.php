<?php

namespace App\DataFixtures;

use App\Entity\Type;
use App\Entity\User;
use App\Entity\Brand;
use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        // pour utiliser un service dans un autre
        // on l'injecte par le constructeur
        // le Conteneur de service se chargera de faire le new pour nous.

        // on stocke alors cet objet dans une propriété
        // à laquelle on pourra accéder dans notre code
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {

        /**     user Datas**/


        $userList = [
            [
                'email' => 'admin@admin.com',
                'password' => 'admin',
                'firstname' => 'admin',
                'lastname' => 'admin',
                'roles' => ['ROLE_ADMIN'],
            ],
            [
                'email' => 'manager@manager.com',
                'password' => 'admin',
                'firstname' => 'manager',
                'lastname' => 'manager',
                'roles' => ['ROLE_CATALOG_MANAGER'],
            ],
            [
                'email' => 'user@user.com',
                'password' => 'admin',
                'firstname' => 'user',
                'lastname' => 'user',
                'roles' => ['ROLE_USER'],
            ],
            [
                'email' => 'app@app.com',
                'password' => 'admin',
                'firstname' => 'app',
                'lastname' => 'app',
                'roles' => ['ROLE_USER'],
            ],
        ];

        $userEntityList = [];
        foreach($userList as $currentUser)
        {
            $newUser = new User();
            $hashedPassword = $this->hasher->hashPassword($newUser, $currentUser['password']);
            
            $newUser->setEmail($currentUser['email']);
            $newUser->setPassword($hashedPassword);
            $newUser->setRoles($currentUser['roles']);
            $newUser->setFirstname($currentUser['firstname']);
            $newUser->setLastname($currentUser['lastname']);
            $userEntityList[] = $newUser;
            $manager->persist($newUser);
        }


        // Brands
        $brandList = [
            'oCirage', 'BOOTstrap', 'Talonette', 'Shossures', 
            'O\'shoes', 'Pattes d\'eph', 'PHPieds', 'oPompes'
        ];

        $brandEntities = [];
        foreach ($brandList as $brandName) {
            $brand = new Brand();
            $brand->setName($brandName);
            $brand->setCreatedAt(new \DateTimeImmutable());
            $brandEntities[] = $brand;
            $manager->persist($brand);
        }

        // Categories
        $categoryList = [
            ['name' => 'Détente', 'subtitle' => 'Se faire plaisir', 'picture' => 'assets/images/categ1.jpeg', 'homeOrder' => 4],
            ['name' => 'Au travail', 'subtitle' => 'C\'est parti', 'picture' => 'assets/images/categ2.jpeg', 'homeOrder' => 2],
            ['name' => 'Cérémonie', 'subtitle' => 'Bien choisir', 'picture' => 'assets/images/categ3.jpeg', 'homeOrder' => 5],
            ['name' => 'Sortir', 'subtitle' => 'Faire un tour', 'picture' => 'assets/images/categ4.jpeg', 'homeOrder' => 3],
            ['name' => 'Vintage', 'subtitle' => 'Découvrir', 'picture' => 'assets/images/categ5.jpeg', 'homeOrder' => 1],
            ['name' => 'Piscine et bains', 'subtitle' => null, 'picture' => null, 'homeOrder' => 0],
            ['name' => 'Sport', 'subtitle' => null, 'picture' => null, 'homeOrder' => 0],
        ];

        $categoryEntities = [];
        foreach ($categoryList as $categoryData) {
            $category = new Category();
            $category->setName($categoryData['name']);
            $category->setSubtitle($categoryData['subtitle']);
            $category->setPicture($categoryData['picture']);
            $category->setHomeOrder($categoryData['homeOrder']);
            $category->setCreatedAt(new \DateTimeImmutable());
            $categoryEntities[] = $category;
            $manager->persist($category);
        }

        // Types
        $typeList = [
            'Chaussures de ville', 'Chaussures de sport', 'Tongs', 
            'Chaussures ouvertes', 'Talons éguilles', 'Talons', 
            'Pantoufles', 'Chaussons'
        ];

        $typeEntities = [];
        foreach ($typeList as $typeName) {
            $type = new Type();
            $type->setName($typeName);
            $type->setCreatedAt(new \DateTimeImmutable());
            $typeEntities[] = $type;
            $manager->persist($type);
        }

        // Products
        $productList = [
            [
                'name' => 'Kissing', 
                'description' => 'Proinde concepta rabie saeviore, quam desperatio incendebat et fames, amplificatis viribus ardore incohibili in excidium urbium matris Seleuciae efferebantur, quam comes tuebatur Castricius tresque legiones bellicis sudoribus induratae.', 
                'picture' => 'assets/images/produits/1-kiss.jpg', 
                'price' => 40, 
                'rate' => 4, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 2, 
                'type' => 7, 
                'categories' => [1]
            ],
            [
                'name' => 'Pink Lady', 
                'description' => 'Nunc vero inanes flatus quorundam vile esse quicquid extra urbis pomerium nascitur aestimant praeter orbos et caelibes, nec credi potest qua obsequiorum diversitate coluntur homines sine liberis Romae.', 
                'picture' => 'assets/images/produits/2-rose.jpg', 
                'price' => 20, 
                'rate' => 2, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 4, 
                'type' => 2, 
                'categories' => [6]
            ],
            [
                'name' => 'Panda', 
                'description' => 'Homines enim eruditos et sobrios ut infaustos et inutiles vitant, eo quoque accedente quod et nomenclatores adsueti haec et talia venditare, mercede accepta lucris quosdam et prandiis inserunt subditicios ignobiles et obscuros.', 
                'picture' => 'assets/images/produits/3-panda.jpg', 
                'price' => 50, 
                'rate' => 5, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 5, 
                'type' => 7, 
                'categories' => [1]
            ],
            [
                'name' => 'Zombie', 
                'description' => 'Sed si ille hac tam eximia fortuna propter utilitatem rei publicae frui non properat, ut omnia illa conficiat, quid ego, senator, facere debeo, quem, etiamsi ille aliud vellet, rei publicae consulere oporteret?', 
                'picture' => 'assets/images/produits/4-zombie.jpg', 
                'price' => 40, 
                'rate' => 2, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 7, 
                'type' => 7, 
                'categories' => [1]
            ],
            [
                'name' => 'Minion', 
                'description' => 'Ut enim benefici liberalesque sumus, non ut exigamus gratiam (neque enim beneficium faeneramur sed natura propensi ad liberalitatem sumus), sic amicitiam non spe mercedis adducti sed quod omnis eius fructus in ipso amore inest, expetendam putamus.', 
                'picture' => 'assets/images/produits/5-minion.jpg', 
                'price' => 44, 
                'rate' => 3, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 6, 
                'type' => 7, 
                'categories' => [1]
            ],
            [
                'name' => 'Père Noël', 
                'description' => 'Tempore quo primis auspiciis in mundanum fulgorem surgeret victura dum erunt homines Roma, ut augeretur sublimibus incrementis, foedere pacis aeternae Virtus convenit atque Fortuna plerumque dissidentes, quarum si altera defuisset, ad perfectam non venerat summitatem.', 
                'picture' => 'assets/images/produits/6-pernoel.jpg', 
                'price' => 36, 
                'rate' => 2, 
                'status' => 2, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 8, 
                'type' => 7, 
                'categories' => [1]
            ],
            [
                'name' => 'Sleepy', 
                'description' => 'Vita est illis semper in fuga uxoresque mercenariae conductae ad tempus ex pacto atque, ut sit species matrimonii, dotis nomine futura coniunx hastam et tabernaculum offert marito, post statum diem si id elegerit discessura, et incredibile est quo ardore apud eos in venerem uterque solvitur sexus.', 
                'picture' => 'assets/images/produits/7-sleepy.jpg', 
                'price' => 40, 
                'rate' => 3, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 4, 
                'type' => 7, 
                'categories' => [1]
            ],
            [
                'name' => 'Bear', 
                'description' => 'Fieri, inquam, Triari, nullo pacto potest, ut non dicas, quid non probes eius, a quo dissentias. quid enim me prohiberet Epicureum esse, si probarem, quae ille diceret? cum praesertim illa perdiscere ludus esset.', 
                'picture' => 'assets/images/produits/8-bear.jpg', 
                'price' => 46, 
                'rate' => 4, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 5, 
                'type' => 7, 
                'categories' => [1]
            ],
            [
                'name' => 'Pantufa', 
                'description' => 'Quam ob rem dissentientium inter se reprehensiones non sunt vituperandae, maledicta, contumeliae, tum iracundiae, contentiones concertationesque in disputando pertinaces indignae philosophia mihi videri solent.', 
                'picture' => 'assets/images/produits/9-pantufa.jpg', 
                'price' => 48, 
                'rate' => 4, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 6, 
                'type' => 7, 
                'categories' => [1]
            ],
            [
                'name' => 'Jack', 
                'description' => 'Quam ob rem id primum videamus, si placet, quatenus amor in amicitia progredi debeat. Numne, si Coriolanus habuit amicos, ferre contra patriam arma illi cum Coriolano debuerunt? num Vecellinum amici regnum adpetentem, num Maelium debuerunt iuvare?', 
                'picture' => 'assets/images/produits/10-jack.jpg', 
                'price' => 50, 
                'rate' => 3, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 8, 
                'type' => 7, 
                'categories' => [1]
            ],
            [
                'name' => 'Teeturtle', 
                'description' => 'Nec minus feminae quoque calamitatum participes fuere similium. nam ex hoc quoque sexu peremptae sunt originis altae conplures, adulteriorum flagitiis obnoxiae vel stuprorum. inter quas notiores fuere Claritas et Flaviana, quarum altera cum duceretur ad mortem.', 
                'picture' => 'assets/images/produits/11-teeturtle.jpg', 
                'price' => 50, 
                'rate' => 3, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 7, 
                'type' => 7, 
                'categories' => [1]
            ],
            [
                'name' => 'Pikachu', 
                'description' => 'Claritas et Flaviana, quarum altera cum duceretur ad mortem, indumento, quo vestita erat, abrepto, ne velemen quidem secreto membrorum sufficiens retinere permissa est. ideoque carnifex nefas admisisse convictus inmane, vivus exustus est.', 
                'picture' => 'assets/images/produits/12-pika.jpg', 
                'price' => 50, 
                'rate' => 4, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 2, 
                'type' => 7, 
                'categories' => [1]
            ],
            [
                'name' => 'Unicorn', 
                'description' => 'Haec igitur Epicuri non probo, inquam. De cetero vellem equidem aut ipse doctrinis fuisset instructior est enim, quod tibi ita videri necesse est, non satis politus iis artibus, quas qui tenent, eruditi appellantur aut ne deterruisset alios a studiis. quamquam te quidem video minime esse deterritum.', 
                'picture' => 'assets/images/produits/13-unicorn.jpg', 
                'price' => 50, 
                'rate' => 4, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 5, 
                'type' => 7, 
                'categories' => [1]
            ],
            [
                'name' => 'Shark', 
                'description' => 'Intellectum est enim mihi quidem in multis, et maxime in me ipso, sed paulo ante in omnibus, cum M. Marcellum senatui reique publicae concessisti, commemoratis praesertim offensionibus, te auctoritatem huius ordinis dignitatemque rei publicae tuis vel doloribus vel suspicionibus anteferre', 
                'picture' => 'assets/images/produits/14-shark.jpg', 
                'price' => 40, 
                'rate' => 3, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 7, 
                'type' => 7, 
                'categories' => [1]
            ],
            [
                'name' => 'Eagles', 
                'description' => 'Ille quidem fructum omnis ante actae vitae hodierno die maximum cepit, cum summo consensu senatus, tum iudicio tuo gravissimo et maximo. Ex quo profecto intellegis quanta in dato beneficio sit laus, cum in accepto sit tanta gloria.', 
                'picture' => 'assets/images/produits/15-eagle.jpg', 
                'price' => 34, 
                'rate' => 2, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 2, 
                'type' => 7, 
                'categories' => [1]
            ],
            [
                'name' => 'Pokeball', 
                'description' => 'Sed ut tum ad senem senex de senectute, sic hoc libro ad amicum amicissimus scripsi de amicitia. Tum est Cato locutus, quo erat nemo fere senior temporibus illis, nemo prudentior; nunc Laelius et sapiens (sic enim est habitus) et amicitiae gloria excellens de amicitia loquetur.', 
                'picture' => 'assets/images/produits/18-pokeball.jpg', 
                'price' => 46, 
                'rate' => 3, 
                'status' => 2, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 8, 
                'type' => 7, 
                'categories' => [1]
            ],
            [
                'name' => 'Hobbit', 
                'description' => 'Tu velim a me animum parumper avertas, Laelium loqui ipsum putes. C. Fannius et Q. Mucius ad socerum veniunt post mortem Africani; ab his sermo oritur, respondet Laelius, cuius tota disputatio est de amicitia, quam legens te ipse cognosces.', 
                'picture' => 'assets/images/produits/19-hobbit.jpg', 
                'price' => 46, 
                'rate' => 3, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 6, 
                'type' => 7, 
                'categories' => [1]
            ],
            [
                'name' => 'Deadpool', 
                'description' => 'Pandente itaque viam fatorum sorte tristissima, qua praestitutum erat eum vita et imperio spoliari, itineribus interiectis permutatione iumentorum emensis venit Petobionem oppidum Noricorum, ubi reseratae sunt insidiarum latebrae omnes, et Barbatio repente apparuit comes.', 
                'picture' => 'assets/images/produits/20-deadpool.jpg', 
                'price' => 36, 
                'rate' => 4, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 2, 
                'type' => 7, 
                'categories' => [1]
            ],
            [
                'name' => 'Converse', 
                'description' => 'Sed ut tum ad senem senex de senectute, sic hoc libro ad amicum amicissimus scripsi de amicitia. Tum est Cato locutus, quo erat nemo fere senior temporibus illis, nemo prudentior; nunc Laelius et sapiens (sic enim est habitus) et amicitiae gloria excellens de amicitia loquetur.', 
                'picture' => 'assets/images/produits/21-converse.jpg', 
                'price' => 60, 
                'rate' => 3, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 5, 
                'type' => 1, 
                'categories' => [5]
            ],
            [
                'name' => 'Mike', 
                'description' => 'Tu velim a me animum parumper avertas, Laelium loqui ipsum putes. C. Fannius et Q. Mucius ad socerum veniunt post mortem Africani; ab his sermo oritur, respondet Laelius, cuius tota disputatio est de amicitia, quam legens te ipse cognosces.', 
                'picture' => 'assets/images/produits/22-nike.jpg', 
                'price' => 68, 
                'rate' => 3, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 5, 
                'type' => 1, 
                'categories' => [4]
            ],
            [
                'name' => 'Jardon', 
                'description' => 'Fieri, inquam, Triari, nullo pacto potest, ut non dicas, quid non probes eius, a quo dissentias. quid enim me prohiberet Epicureum esse, si probarem, quae ille diceret? cum praesertim illa perdiscere ludus esset.', 
                'picture' => 'assets/images/produits/23-jordan.jpg', 
                'price' => 120, 
                'rate' => 4, 
                'status' => 2, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 7, 
                'type' => 2, 
                'categories' => [7]
            ],
            [
                'name' => 'Running', 
                'description' => 'Fieri, inquam, Triari, nullo pacto potest, ut non dicas, quid non probes eius, a quo dissentias. quid enim me prohiberet Epicureum esse, si probarem, quae ille diceret? cum praesertim illa perdiscere ludus esset.', 
                'picture' => 'assets/images/produits/24-running-nike.jpg', 
                'price' => 80, 
                'rate' => 3, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 5, 
                'type' => 2, 
                'categories' => [7]
            ],
            [
                'name' => 'Sans dale', 
                'description' => 'Nunc vero inanes flatus quorundam vile esse quicquid extra urbis pomerium nascitur aestimant praeter orbos et caelibes, nec credi potest qua obsequiorum diversitate coluntur homines sine liberis Romae.', 
                'picture' => 'assets/images/produits/25-100dales.jpg', 
                'price' => 23, 
                'rate' => 2, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 7, 
                'type' => 4, 
                'categories' => [3]
            ],
            [
                'name' => 'Talon aibrille', 
                'description' => 'Proinde concepta rabie saeviore, quam desperatio incendebat et fames, amplificatis viribus ardore incohibili in excidium urbium matris Seleuciae efferebantur, quam comes tuebatur Castricius tresque legiones bellicis sudoribus induratae.', 
                'picture' => 'assets/images/produits/26-oCirage.jpg', 
                'price' => 240, 
                'rate' => 5, 
                'status' => 1, 
                'createdAt' => '2018-10-17 11:00:00', 
                'brand' => 3, 
                'type' => 5, 
                'categories' => [3]
            ],
        
            // Add more products here following the same structure...
        ];

        foreach ($productList as $productData) {
            $product = new Product();
            $product->setName($productData['name']);
            $product->setDescription($productData['description']);
            $product->setPicture($productData['picture']);
            $product->setPrice($productData['price']);
            $product->setRate($productData['rate']);
            $product->setStatus($productData['status']);
            $product->setCreatedAt(new \DateTimeImmutable($productData['createdAt']));
            $product->setBrand($brandEntities[$productData['brand'] - 1]);
            $product->setType($typeEntities[$productData['type'] - 1]);
            
            $categoryId = $productData['categories'][0]; 
            $product->addCategory($categoryEntities[$categoryId - 1]);
            

            $manager->persist($product);
        }

        $manager->flush();
    }
}
