<link rel="stylesheet" href="../styles/formsStyle.css">
<div class="container">
    <form method="post">
        <div class="col-25">
            <label>Марка: </label>
        </div>
        <div class="col-75">
            <input type="text" name="brand" />
        </div>

        <div class="col-25">
            <label>Модель: </label>
        </div>
        <div class="col-75">
            <input type="text" name="model" />
        </div>

        <div class="col-25">
            <label>Рік випуску: </label>
        </div>
        <div class="col-75">
            <input type="number" name="year_of_edition" />
        </div>

        <div class="col-25">
            <label>Вартість: </label>
        </div>
        <div class="col-75">
            <input type="number" name="price" />
        </div>

        <div class="col-25">
            <label>Дата продажу: </label>
        </div>
        <div class="col-75">
            <input type="date" name="date_of_sale" />
        </div>

        <div class="col-25">
            <label>Прізвище та ім'я покупця: </label>
        </div>
        <div class="col-75">
            <input type="text" name="name_of_customer" />
        </div>

        <div>
            <label><input type="submit" name="submit" value="Зберегти" /></label>
        </div>
    </form>
</div>