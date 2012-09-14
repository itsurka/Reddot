<?php
/**
 * User: Kuklin Mikhail (mikhail@clevertech.biz)
 * Company: Clevertech LLC.
 * Date: 11.07.12 18:37
 */
class Utils
{
    /**
     * Функция которая добавляет правильное окончание к русскому слову использованному после числа.
     * @param $aWords - Массив из четырех форм слова: первый элемент для 1, второй для 4, третий для 7, array('год','года','лет')
     * @param $iNum - число
     * @return string
     */
    public static function wordAfterNum($aWords, $iNum)
    {
        $iNum = $iNum % 100;
        if (count($aWords) > 2)
        {
            if ($iNum > 4 && $iNum < 21)
            {
                return $aWords[2];
            } else
            {
                $iOst = $iNum % 10;
                if ($iOst == 1)
                {
                    return $aWords[0];
                } elseif ($iOst > 1 && $iOst < 5)
                {
                    return $aWords[1];
                } else
                {
                    return $aWords[2];
                }
            }
        } else
        {
            if ($iNum > 1 && $iNum < 21)
            {
                return $aWords[1];
            } else
            {
                $iOst = $iNum % 10;
                if ($iOst == 1)
                {
                    return $aWords[0];
                } else
                {
                    return $aWords[1];
                }
            }
        }
    }
}
