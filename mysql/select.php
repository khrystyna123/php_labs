<?php

$select = "SELECT brand, model, year_of_edition, price, date_of_sale, firstname, lastname
FROM brands b, prices p, customers c, models m, sales s
WHERE b.id = m.brand_id and p.id = m.price_id and m.id = s.model_id and c.id = s.customer_id";