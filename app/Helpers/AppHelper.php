<?php

namespace App\Helpers;

class AppHelper
{
    public static function date_compare($firstElement, $secondElement) {
        $datetimeOne = strtotime($firstElement['created_at']);
        $datetimeTwo = strtotime($secondElement['created_at']);
        return $datetimeTwo - $datetimeOne;
    }

    public static function defaultMetaInput($input) : array
    {
        $page = isset($input['page']) ? (int)$input['page'] : 1;
        $perPage = isset($input['perPage']) ? (int)$input['perPage'] : 20;
        $order = $input['order'] ?? 'created_at';
        $dir = $input['dir'] ?? 'desc';
        $search = isset($input['search']) ? ($input['search']) : '';
        $offset = ($page - 1) * $perPage;
        return [
            'order'     => $order,
            'dir'       => $dir,
            'page'      => $page,
            'perPage'   => $perPage,
            'offset'    => $offset,
            'search'    => $search,
        ];
    }

    public static function additionalMeta($meta, $total)
    {
        $meta['total'] = $total;
        $meta['totalPage'] = ceil( $total / $meta['perPage']);
        if($meta['totalPage'] < $meta['page']){
            $meta['page'] = $meta['totalPage'];
        }
        return $meta;
    }

    public static function conversionDateTime($dateTime) {
        $newDateTime = strtotime($dateTime);
        $newDateTime = date('d/m/Y H:i:s', $newDateTime);
        return $newDateTime;
    }

}