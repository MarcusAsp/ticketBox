<?php
/*
   Den här filen loggar ut admin och förstör sessionen samt länkar till index sidan.
*/ 
  session_start();
  unset($_SESSION['admin']);
  session_destroy();
  header("Location: ../../index");