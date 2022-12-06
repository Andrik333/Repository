<?php

namespace zadanie_7;

class CreateData
{
    public function run($db)
    {
        $methods = implode(', ', get_class_methods(__CLASS__));
        preg_match_all('/\binsertData\w+\b/', $methods, $matches);

        foreach ($matches[0] as $method) {
            $db->exec($this->$method());
        }
    }

    private function insertDataProducts()
    {
        return "INSERT INTO products (name, price, count, category) VALUES 
            ('Acer HT342-27', 28399.90, 9, 1),
            ('Asus JG342-RF43', 38000, 29, 1),
            ('ViewSonic 34123-17R', 15800, 42, 1),
            ('HP JGI242-RE 23', 22300, 67, 1),
            ('Lenovo RCN23234 27', 31700, 26, 1),
            ('4-Tech xn231', 1300, 16, 2),
            ('Redragon Mirage', 4300, 12, 2),
            ('Asus TUF 131GT', 7050, 59, 2),
            ('DEXP 4X-GHR35', 1700, 29, 2),
            ('Lenovo ideaPad RT42-15', 39000, 111, 3),
            ('Asus ROG Strix G15', 120000, 7, 3),
            ('Lenovo V580C', 27000, 4, 3),
            ('HP ExpertBook', 59000, 14, 3),
            ('Arec N15 34051T', 43000, 11, 3),
            ('Intel Core i5-12350U', 23000, 19, 4),
            ('Intel Core i3-10500H', 19000, 25, 4),
            ('AMD Rizen 5 3800HX', 29000, 24, 4),
            ('AMD Rizen 9 5900X', 37000, 9, 4),
            ('Intel Core i7-11700X', 38000, 29, 4),
            ('Hitachi HDT9238T', 3700, 53, 5),
            ('AMD Radeon R5 Series', 1900, 35, 5),
            ('Team Group GX2', 3500, 42, 5),
            ('Dato DS700', 4200, 21, 5),
            ('MSI Spatium DR300', 2300, 62, 5),
            ('NVidia RTX 3070', 75000, 30, 6),
            ('AMD Radeon 6700NX', 64000, 23, 6),
            ('NVidia RTX 3060TI', 53000, 32, 6),
            ('AMD Radeon RX570T', 32000, 7, 6),
            ('NVidia RTX 3080', 94000, 17, 6),
            ('Asus rt-3412P', 4600, 26, 7),
            ('Tenda NR-4234', 1600, 66, 7),
            ('TP-LINK MS242', 6100, 52, 7),
            ('MI WD-23213BV', 3200, 64, 7),
            ('Acer XMT 3424', 7400, 31, 7),
            ('Nokia n13', 29999, 69, 8),
            ('MI 11 Lite', 21000, 27, 8),
            ('Samsung Galaxy Note 9', 59000, 58, 8),
            ('Honor 13 Pro', 32000, 94, 8),
            ('Redmi 15', 2600, 91, 8),
            ('Vivo R2312', 1500, 23, 8),
            ('Candi NQ-43321 NR', 32000, 18, 9),
            ('Supra TR34123', 25000, 14, 9),
            ('LG NTM-1241', 79000, 6, 9),
            ('Hitachi XC1241', 52000, 46, 9),
            ('Bosch GT-24FS', 42000, 61, 9),
            ('HP laserJet 4235NR', 7250, 59, 10),
            ('Samsung GV3423-FG5', 1200, 42, 10),
            ('HP laserJet 23452NG', 2600, 33, 10),
            ('Acer laserPro GW-2321', 1100, 30, 10)";
    }

    private function insertDataProductCategory()
    {
        return "INSERT INTO product_category (name) VALUES
            ('Мониторы'),
            ('Клавиатуры'),
            ('Ноутбуки'),
            ('Процессоры'),
            ('Накопители'),
            ('Видео карты'),
            ('Роутеры'),
            ('Смартфоны'),
            ('Холодильники'),
            ('Принтеры')";
    }

    private function insertDataSales()
    {
        return "INSERT INTO sales (name, description, dob, doe, sale_procent, products) VALUES
            ('Nvidia sales', 'Скидки на видеокарты Nvidia RTX 3070 10%', '2022-10-10', '2022-12-20', 10, 1),
            ('Распродажа ноутбуков', 'Скидки на все ноутбуки 5%', '2022-11-30', '2022-12-31', 5, 2),
            ('Распродажа принтеров', 'Скидки на все принтеры HP 15%', '2022-11-20', '2022-12-20', 15, 3),
            ('Распродажа мониторов', 'Скидка 20% на монитор Asus JG342-RF43', '2022-11-10', '2022-12-10', 20, 4),
            ('Распродажа HP', 'Скидка 7% на продукцию HP', '2022-07-12', '2022-08-27', 7, 5),
            ('Распродажа Nokian n13', 'Скидка 25% на смартфон Nokia n13', '2022-08-26', '2022-09-25', 25, 6),
            ('Распродажа Intel', 'Скидка 10% на процессоры Intel', '2022-09-13', '2022-09-25', 10, 7)";
    }

    private function insertDataSalesPoructs()
    {
        return "INSERT INTO sales_products (sale, product) VALUES
            (1, 25),
            (2, 10),
            (2, 11),
            (2, 12),
            (2, 13),
            (2, 14),
            (3, 46),
            (3, 48),
            (4, 2),
            (5, 4),
            (5, 13),
            (5, 46),
            (5, 48),
            (6, 35),
            (7, 15),
            (7, 16),
            (7, 19)";
    }

    private function insertDataOrders()
    {
        return "INSERT INTO orders (order_number, products, count, date_purchase, sale) VALUES 
            (23, 1, 2, '2022-11-12', 1), 
            (11, 2, 1, '2021-10-09', 2), 
            (67, 3, 3, '2022-11-19', 3), 
            (35, 4, 1, '2022-12-03', 4), 
            (98, 5, 2, '2021-11-05', 5), 
            (46, 6, 2, '2022-07-09', 3), 
            (463, 7, 4, '2022-10-25', 7), 
            (96, 8, 2, '2022-01-16', 2), 
            (765, 9, 1, '2022-07-22', 4), 
            (67, 10, 1, '2022-10-11', 1)";
    }

    private function insertDataOrdersPorducts()
    {
        return "INSERT INTO orders_products (orders, product) VALUES
            (1, 25),
            (1, 19),
            (2, 11),
            (3, 48),
            (3, 36),
            (3, 6),
            (4, 2),
            (5, 13),
            (5, 46),
            (6, 39),
            (6, 47),
            (7, 19),
            (7, 18),
            (7, 34),
            (7, 20),
            (8, 15),
            (8, 40),
            (9, 28),
            (10, 10)";
    }
}