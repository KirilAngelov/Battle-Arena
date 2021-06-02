<?php


class Scenes
{

    public function __construct()
    {
    }

    public function displayOrc2()
    {
        ?>
        <form action="../templates/orcStage2.html" method="POST">
            <div class="submit">
                <input class="search" name="forHorde" type="submit" value="Escape!">
            </div>
        </form>
        <?php
    }

    public function displayWarrior2()
    {

        ?>
        <form action="../templates/warrior_stage2.html" method="POST">
            <div class="submit">
                <input class="search" name="forPeople" type="submit" value="Escape!">
            </div>
        </form>
        <?php

    }
    public function ending()
    {
        ?>
        <form action="../templates/End.html" method="POST">
            <div class="submit">
                <input class="search" name="forPeople" type="submit" value="...">
            </div>
        </form>
        <?php
    }


    public function displayShop()
    {
        //change action to display shop page
        ?>
        <form action="../templates/reunion.html" method="POST">
            <div class="submit">
                <input class="search" name="forPeople" type="submit" value="Victory!">
            </div>
        </form>
        <?php
    }

}