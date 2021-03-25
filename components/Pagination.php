<?php

/*
 * Класс для генерации постраничной навигации
 */

class Pagination
{
    private $max = 3;

    private $index = 'page';

    private $current_page;

    private $total;

    private $limit;

    /**
     * Запуск необходимых данных для навигации
     * @param integer $total - общее количество записей
     * @param integer $limit - количество записей на страницу
     * 
     * @return
     */

    public function __construct($total, $currentPage, $limit, $index)
    {
        # Устанавливаем общее количество записей
        $this->total = $total;

        # Устанавливаем количество записей на страницу
        $this->limit = $limit;

        # Устанавливаем ключ в url
        $this->index = $index;

        # Устанавливаем количество страниц
        $this->amount = $this->amount();

        # Устанавливаем номер текущей страницы
        $this->setCurrentPage($currentPage);
    }

    /**
     *  Для вывода ссылок
     * 
     * @return HTML-код со ссылками навигации
     */
    public function get()
    {
        # Для записи ссылок
        $links = null;

        # Получаем ограничения для цикла
        $limits = $this->limits();

        $html = '<ul class="pagination">';
        # Генерируем ссылки
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {

            # Если текущая это текущая страница, ссылки нет и добавляется класс active
            if ($page == $this->current_page) {
                $links .= '<li class="active"><a href="#" class="item-pagination flex-c-m trans-0-4">' . $page . '</a></li>';
            } else {
                # Иначе генерируем ссылку
                $links .= $this->generateHtml($page);
            }
        }

        # Если ссылки создались
        if (!is_null($links)) {
            # Если текущая страница не первая
            if ($this->current_page > 1)
            # Создаём ссылку "На первую"
                $links = $this->generateHtml(1, '&lt;') . $links;

            # Если текущая страница не первая
            if ($this->current_page < $this->amount)
            # Создаём ссылку "На последнюю"
                $links .= $this->generateHtml($this->amount, '&gt;');
        }

        $html .= $links . '</ul>';

        # Возвращаем html
        return $html;
    }

    /**
     * Для генерации HTML-кода ссылки
     * @param integer $page - номер страницы
     * 
     * @return
     */
    private function generateHtml($page, $text = null)
    {
        # Если текст ссылки не указан
        if (!$text)
        # Указываем, что текст - цифра страницы
            $text = $page;

        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);
        # Формируем HTML код ссылки и возвращаем
        return
                '<li><a href="' . $currentURI . $this->index . $page . '" class="item-pagination flex-c-m trans-0-4">' . $text . '</a></li>';
    }

    /**
     *  Для получения, откуда стартовать
     * 
     * @return массив с началом и концом отсчёта
     */
    private function limits()
    {
        # Вычисляем ссылки слева (чтобы активная ссылка была посередине)
        $left = $this->current_page - ceil($this->max / 2);

        # Вычисляем начало отсчёта
        $start = $left > 0 ? $left : 1;

        # Если впереди есть как минимум $this->max страниц
        if ($start + $this->max <= $this->amount)
        # Назначаем конец цикла вперёд на $this->max страниц или просто на минимум
            $end = $start > 1 ? $start + $this->max : $this->max;
        else {
            # Конец - общее количество страниц
            $end = $this->amount;

            # Начало - минус $this->max от конца
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }

        # Возвращаем
        return
                array($start, $end);
    }

    /**
     * Для установки текущей страницы
     * 
     * @return
     */
    private function setCurrentPage($currentPage)
    {
        # Получаем номер страницы
        $this->current_page = $currentPage;

        # Если текущая страница боле нуля
        if ($this->current_page > 0) {
            # Если текунщая страница меньше общего количества страниц
            if ($this->current_page > $this->amount)
            # Устанавливаем страницу на последнюю
                $this->current_page = $this->amount;
        } else
        # Устанавливаем страницу на первую
            $this->current_page = 1;
    }

    /**
     * Для получеия общего числа страниц
     * 
     * @return число страниц
     */
    private function amount()
    {
        # Делим и возвращаем
        return ceil($this->total / $this->limit);
    }
/**
 * Displays pagination links based on given parameters
 *
 * @param int $currentPage - current page
 * @param int $this->total - number of items to paginate, used to calculate total number of pages
 * @param int $this->limit - number of items per page, used to calculate total number of pages
 * @param int $adjacentCount - half the number of page links displayed adjacent to the current page
 * @param (string|callable) $this->index - pagination URL string containing %d placeholder or a callable function that accepts page number and returns page URL
 * @param boolean $showPrevNext - whether to show previous and next page links
 * @return void
 */
// function pagination($adjacentCount, $showPrevNext = true) {
//     $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
//     $currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);

//     $firstPage = 1;
//     $lastPage  = ceil($this->total / $this->limit);
//     if ($lastPage == 1) {
//         return;
//     }
//     if ($this->current_page <= $adjacentCount + $adjacentCount) {
//         $firstAdjacentPage = $firstPage;
//         $lastAdjacentPage  = min($firstPage + $adjacentCount + $adjacentCount, $lastPage);
//     } elseif ($this->current_page > $lastPage - $adjacentCount - $adjacentCount) {
//         $lastAdjacentPage  = $lastPage;
//         $firstAdjacentPage = $lastPage - $adjacentCount - $adjacentCount;
//     } else {
//         $firstAdjacentPage = $this->current_page - $adjacentCount;
//         $lastAdjacentPage  = $this->current_page + $adjacentCount;
//     }
//     echo '<div>';
//     if ($showPrevNext) {
//         if ($this->current_page == $firstPage) {
//             echo '<span>&lt;</span>';
//         } else {
//             echo '<a href="' . $currentURI . $this->index . $this->current_page . '" class="item-pagination flex-c-m trans-0-4">&lt;</a>';
//         }
//     }
//     if ($firstAdjacentPage > $firstPage) {
//         echo '<a href="' . $currentURI . $this->index . $this->current_page . '" class="item-pagination flex-c-m trans-0-4">' . $firstPage . '</a>';
//         if ($firstAdjacentPage > $firstPage + 1) {
//             echo '<span>...</span>';
//         }
//     }
//     for ($i = $firstAdjacentPage; $i <= $lastAdjacentPage; $i++) {
//         if ($this->current_page == $i) {
//             echo '<b>' . $i . '</b>';
//         } else {
//             echo '<a href="' . $currentURI . $this->index . $this->current_page . '" class="item-pagination flex-c-m trans-0-4">' . $i . '</a>';
//         }
//     }
//     if ($lastAdjacentPage < $lastPage) {
//         if ($lastAdjacentPage < $lastPage - 1) {
//             echo '<span>...</span>';
//         }
//         echo '<a href="' . $currentURI . $this->index . $this->current_page . '" class="item-pagination flex-c-m trans-0-4">' . $lastPage . '</a>';
//     }
//     if ($showPrevNext) {
//         if ($this->current_page == $lastPage) {
//             echo '<span>&gt;</span>';
//         } else {
//             echo '<a href="' . $currentURI . $this->index . $this->current_page . '" class="item-pagination flex-c-m trans-0-4">&gt;</a>';
//         }
//     }
//     echo '</div>';
// }

}
