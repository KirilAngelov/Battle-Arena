<?php


class Scenes
{

    public function __construct()
    {
    }

    public function displayOrc2()
    {
        ?>
        <form action="HTML Pages/orcStage2.html" method="POST">
            <div class="submit">
                <input class="search" name="forHorde" type="submit" value="Escape!">
            </div>
        </form>
        <?php
    }

    public function displayWarrior2()
    {
        ?>
        <form action="HTML Pages/warrior_stage2.html" method="POST">
            <div class="submit">
                <input class="search" name="forPeople" type="submit" value="Escape!">
            </div>
        </form>
        <?php
    }

    public function displayShop()
    {
        //change action to display shop page
        ?>
        <form action="HTML Pages/warrior_stage2.html" method="POST">
            <div class="submit">
                <input class="search" name="forPeople" type="submit" value="Victory!">
            </div>
        </form>
        <?php
    }

}