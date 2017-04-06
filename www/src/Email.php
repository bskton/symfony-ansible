<?php
/**
 * Описание для файла Email.php
 *
 * Развернутое описание файла Email.php
 */
declare(strict_types=1);

/**
 * Клас для работы с электронной почтой
 *
 * Позволяет создавать новые объекты для валидации и 
 * работы с адресами электронной почты.
 */
final class Email
{
    /**
     * Адрес электронной почты
     * @var string
     */
    private $email;

    /**
     * @param  string $email Адрес электронной почты
     */
    private function __construct(string $email)
    {
        $this->ensureIsValidEmail($email);

        $this->email = $email;
    }

    /**
     * Создает объект класса Email на основе адреса электронной почты
     * 
     * @param  string $email Адрес электронной почты
     * 
     * @return Email
     */
    public static function fromString(string $email): self
    {
        return new self($email);
    }

    public function __toString(): string
    {
        return $this->email;
    }

     /**
      * Метод валидации адреса электронной почты
      *
      * Валидация проводится встроенными средствами PHP
      *
      * @param string $email Адрес электронной почты
      *
      * @return void
      */
    private function ensureIsValidEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" is not a valid email address',
                    $email
                )
            );
        }
    }
}