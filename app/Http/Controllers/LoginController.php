<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){                    // метод "Вход пользователя"
        if(Auth::check()){                                      // проверка: если юзер зарегистрирован..
            return redirect()->intended('/ToDo/private'); // ..то переход на страницу до редиректа, а если такой страницы нет - то на стр. Private
        }

        $formFields = $request->only(['email', 'password']);    // извлечение из запроса только двух параметров

        //return dd($formFields); // Точка контроля

        if(Auth::attempt($formFields)){                         // залогинивание и проверка: если попытка аутентификации успешна..
            return redirect()->intended('/ToDo/private'); // ..то переход на страницу до редиректа, а если такой страницы нет - то на стр. Private
        }
        return redirect(route('user.login'))->withErrors([ // ..если попытка аутентификации провалилась - редирект и вывод сообщ. об ошибке
            'email' => 'Не удалось аутентифицироваться!'
        ]);
    }
}
