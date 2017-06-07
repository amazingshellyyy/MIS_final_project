<?php
session_start();
namespace Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;

session_start();

class User extends Model
{
  public function userName()
  {
      return DB::table('users')
                // ->where('userId', $_SESSION['user'])
                ->get();
  }
}
