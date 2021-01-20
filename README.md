
# 160202020-product( Ürün Modülü)


### Kurulum

Portal Product modülünü, portal web uygulamasına eklemek için /portal dizininde bulunan composer.json dosyasına gidilerek, aşağıdaki kod parçaları repositories ve require kısımlarına eklenir. Portal dizininde composer update işlemi yapılarak modül yüklenir.

        ....
        "repositories": [
            {
                ....
                {
                    "type": "vcs",
                    "url": "https://github.com/2021-BLM317/portal-160202020.git"
                }
        ],
        "require": {

            ....   
            "kouosl/portal-product": "dev-master"
        },
      ....
  
Ardından Frontend ve Backend için portal klasöründe  portal\frontend\config ve portal\backend\config klasöründeki main.php dosyası aşağıdaki gösterildiği üzere düzenlenir


```
'modules' => [
       ...
     'product' => [
            'class' => '160202020\product\Module',
        ],

   ],

 ```


Modülün yüklenmesinin ardından kullanıcı ve yönetici panellerinin çalışması için gerekli olan "product" ve "hamper" isimli veritabanı tabloları, modülün migrations klasörü içerisinde bulunmaktadır. Migrate işlemi için altta bulunan kod parçasının portal dizininde çalıştırılması gerekmektedir.

    php yii migrate --migrationPath=@vendor/kouosl/portal-product/migrations --interactive=0
    


## Panel Görünümleri

 - Kullanıcı Paneli => [http://portal.kouosl.product](http://portal.kouosl/product)
![product](https://user-images.githubusercontent.com/58732895/72112016-7a905880-334d-11ea-81d2-da4c2a049092.png)
![AddHamper](https://user-images.githubusercontent.com/58732895/72112716-706f5980-334f-11ea-9f0f-c6c955e562c2.png)

 

## Notlar
 - Kullanıcı paneli açıldığında;
    - Sayfanın üst kısmında: Admin panelinden eklenebilen ürünlerden mevcut olarak var olan(stokta olan) ürünler,
    - Sayfanın alt kısmında: Kullanıcın kendi alışveriş sepeti listelenir.
 - Alışveriş sepetinin kişiye özgü olması için user tablosundan username değeri çekilmektedir.

  