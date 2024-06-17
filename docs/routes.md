# Routes

## Sprint 1

| URL | HTTP Method | Controller | Method | Title | Content | Comment |
|--|--|--|--|--|--|--|
| `/` | `GET` | `MainController` | `home` | Dans les shoe | 5 categories | - |
| `/legal-notice/` | `GET`| `MainController` | `legal` | Mentions legales | legal notices of the website | - |
| `/catalog/product/[i:id]` | `GET`| `CatalogController` | `product` | Article | product by id | - |
| `/catalog/category/[i:id]` | `GET` | `CatalogController` | `category` | Dans les shoe | 1 categorie + les articles de cette catégorie | - |
| `/catalog/type/[i:id]` | `GET`| `CatalogController` | `type` | Types d'articles | products by type | represents the id of the type  |
| `/catalog/brand/[i:id]` | `GET`| `CatalogController` | `brand` | Name of the brand | products by brand | [id] represents the id of the brand |


## Sprint 2 (back office)

| URL | HTTP Method | Controller | Method | Title | Content | Comment |
|--|--|--|--|--|--|--|
| `back/` | `GET` | `MainController` | `main` | Dans les shoe | 5 categories | - |
| `/back/product/` | `GET`| `ProductController` | `browse` | Article | product by id | - |
| `/back/category/` | `GET` | `CategoryController` | `browse` | Dans les shoe | 1 categorie + les articles de cette catégorie | - |
| `/back/type/` | `GET`| `TypeController` | `browse` | Types d'articles | products by type | represents the id of the type  |
| `/back/brand/` | `GET`| `BrandController` | `browse` | Name of the brand | products by brand |  represents the id of the brand |
| `/back/user/` | `GET`| `UserController` | `browse` | Name of the users |  users |  represents the id of the user |

