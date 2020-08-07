<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Места которые мне не нравятся.

Тут я хочу описать моменты в коде реализация которых меня либо смутила, либо совсем не понравилась.

- Внутри компонентов vue, (show, if) работают только при рендеринге страницы, и приходилось на js писать тот же функционал.
- Внутри реализации Абстракции CRUD не понравились моменты с использованием ответов REST API, полагаю что можно было разбить код на ещё меньшие куски, и это позволило бы логику в CRUD сменить, а ответы бы остались в абстракции.
