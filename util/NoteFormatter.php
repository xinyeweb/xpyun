<?php

namespace Xpyun\util;

class NoteFormatter
{
    private const ROW_MAX_CHAR_LEN = 32;
	private const ROW_MAX_CHAR_LEN2 = 46;//XPrinter打印机小号字体可以打印字符
    private const MAX_NAME_CHAR_LEN = 20;
	private const MAX_NAME_CHAR_LEN2 = 42;//XPrinter打印机小号字符最大限制（小号字1个汉字占2个字符 42代表21个小号字）
	private const MAX_NAME_CHAR_LEN3 = 20;//XPrinter打印机大号字符最大限制（大号字1个汉字占4个字符 20代表10个大号字）
	private const MAX_NAME_CHAR_LEN4 = 16;//XPrinter【前台】打印机大号字符最大限制（大号字1个汉字占4个字符 10代表5个大号字）
	private const MAX_NAME_CHAR_LEN5 = 38;//XPrinter【前台】打印机小号字符最大限制（大号字1个汉字占4个字符 10代表5个大号字）
    private const LAST_ROW_MAX_NAME_CHAR_LEN = 16;
    private const MAX_QUANTITY_CHAR_LEN = 6;
	private const MAX_QUANTITY_CHAR_LEN2 = 4;
    private const MAX_PRICE_CHAR_LEN = 6;

    /**
     * 格式化菜品列表（用于58mm打印机）
     * 注意：默认字体排版，若是字体宽度倍大后不适用
     * 58mm打印机一行可打印32个字符 汉子按照2个字符算
     * 分3列： 名称20字符一般用16字符4空格填充  数量6字符  单价6字符，不足用英文空格填充 名称过长换行
     *
     * @param foodName 菜品名称
     * @param quantity 数量
     * @param price 价格
     * @throws Exception
     */

    public static function formatPrintOrderItem($foodName, $quantity, $price)
    {
        $orderNameEmpty = str_repeat(" ", self::MAX_NAME_CHAR_LEN);
        $foodNameLen = Encoding::CalcGbkLenForPrint($foodName);
        // print("foodNameLen=".$foodNameLen."\n");

        $quantityStr = '' . $quantity;
        $quantityLen = Encoding::CalcAsciiLenForPrint($quantityStr);
        // print("quantityLen=".$quantityLen."\n");

        $priceStr = '' . round($price, 2);
        $priceLen = Encoding::CalcAsciiLenForPrint($priceStr);
        // print("priceLen=".$priceLen);

        $result = $foodName;
        $mod = $foodNameLen % self::ROW_MAX_CHAR_LEN;
        // print("mod=".$mod."\n");

        if ($mod <= self::LAST_ROW_MAX_NAME_CHAR_LEN) {
            // 保证各个列的宽度固定，不足部分，利用空格填充
            //make sure all the column length fixed, fill with space if not enough
            $result = $result . str_repeat(" ", self::MAX_NAME_CHAR_LEN - $mod);

        } else {
            // 另起新行
            // new line
            $result = $result . "<BR>";
            $result = $result . $orderNameEmpty;
        }

        $result = $result . $quantityStr . str_repeat(" ", self::MAX_QUANTITY_CHAR_LEN - $quantityLen);
        $result = $result . $priceStr . str_repeat(" ", self::MAX_PRICE_CHAR_LEN - $priceLen);

        $result = $result . "<BR>";

        return $result;
    }
	
	//XPrinter小号字-前台
	 public static function formatPrintOrderItemSXpy($foodName, $quantity,$price)
    {
        $orderNameEmpty = str_repeat(" ", self::MAX_NAME_CHAR_LEN5);
        $foodNameLen = Encoding::CalcGbkLenForPrint($foodName);
        $quantityStr = 'x' . $quantity;
        $quantityLen = Encoding::CalcAsciiLenForPrint($quantityStr);
		
		$priceStr = '' . round($price, 2);
        $priceLen = Encoding::CalcAsciiLenForPrint($priceStr);


        $result = $foodName;
        $mod = $foodNameLen % self::ROW_MAX_CHAR_LEN2;

        if ($mod <= self::MAX_NAME_CHAR_LEN5) {
            $result = $result . str_repeat(" ", self::MAX_NAME_CHAR_LEN5 - $mod);

        } else {
            $result = $result . "<BR>";
            $result = $result . $orderNameEmpty;
        }

		$result = $result . $quantityStr . str_repeat(" ", self::MAX_QUANTITY_CHAR_LEN2 - $quantityLen);
		$result = $result . $priceStr;

        return $result;
    }
	
	//XPrinter大号字-前台
	 public static function formatPrintOrderItemBXpy($foodName, $quantity,$price)
    {
        $orderNameEmpty = str_repeat(" ", self::MAX_NAME_CHAR_LEN4);
        $foodNameLen = Encoding::CalcGbkLenForPrint($foodName);
        $quantityStr = 'x' . $quantity;
        $quantityLen = Encoding::CalcAsciiLenForPrint($quantityStr);
		
		$priceStr = '' . round($price, 2);
        $priceLen = Encoding::CalcAsciiLenForPrint($priceStr);


        $result = $foodName;
        $mod = $foodNameLen % self::ROW_MAX_CHAR_LEN2;

        if ($mod <= self::MAX_NAME_CHAR_LEN4) {
            $result = $result . str_repeat(" ", self::MAX_NAME_CHAR_LEN4 - $mod);

        } else {
            $result = $result . "<BR>";
            $result = $result . $orderNameEmpty;
        }

		$result = $result . $quantityStr . str_repeat(" ", self::MAX_QUANTITY_CHAR_LEN2 - $quantityLen);
		$result = $result . $priceStr;

        return $result;
    }
	
	
	//XPrinter小号字-后厨
	 public static function formatPrintOrderItemSback($foodName, $quantity)
    {
        $orderNameEmpty = str_repeat(" ", self::MAX_NAME_CHAR_LEN2);
        $foodNameLen = Encoding::CalcGbkLenForPrint($foodName);
        // print("foodNameLen=".$foodNameLen."\n");

        $quantityStr = 'x' . $quantity;
        $quantityLen = Encoding::CalcAsciiLenForPrint($quantityStr);
        // print("quantityLen=".$quantityLen."\n");

       
        // print("priceLen=".$priceLen);

        $result = $foodName;
        $mod = $foodNameLen % self::ROW_MAX_CHAR_LEN2;
        // print("mod=".$mod."\n");

        if ($mod <= self::MAX_NAME_CHAR_LEN2) {
            // 保证各个列的宽度固定，不足部分，利用空格填充
            //make sure all the column length fixed, fill with space if not enough
            $result = $result . str_repeat(" ", self::MAX_NAME_CHAR_LEN2 - $mod);

        } else {
            // 另起新行
            // new line
            $result = $result . "<BR>";
            $result = $result . $orderNameEmpty;
        }

        $result = $result . $quantityStr;

        return $result;
    }
	
	//XPrinter大号字-后厨
	 public static function formatPrintOrderItemBback($foodName, $quantity)
    {
        $orderNameEmpty = str_repeat(" ", self::MAX_NAME_CHAR_LEN3);
        $foodNameLen = Encoding::CalcGbkLenForPrint($foodName);
        $quantityStr = 'x' . $quantity;
        $quantityLen = Encoding::CalcAsciiLenForPrint($quantityStr);


        $result = $foodName;
        $mod = $foodNameLen % self::ROW_MAX_CHAR_LEN2;

        if ($mod <= self::MAX_NAME_CHAR_LEN3) {
            $result = $result . str_repeat(" ", self::MAX_NAME_CHAR_LEN3 - $mod);

        } else {
            $result = $result . "<BR>";
            $result = $result . $orderNameEmpty;
        }

        $result = $result . $quantityStr;
		


        return $result;
    }
	
}

?>