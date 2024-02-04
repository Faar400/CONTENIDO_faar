<?php

/**
 * This file contains the scrollable lists GUI class.
 *
 * @package    Core
 * @subpackage GUI
 * @author     Mischa Holz
 * @copyright  four for business AG <www.4fb.de>
 * @license    https://www.contenido.org/license/LIZENZ.txt
 * @link       https://www.4fb.de
 * @link       https://www.contenido.org
 */

defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.');

/**
 * Scrollable lists GUI class.
 *
 * @TODO This class has similarities to {@see FrontendList}, we may think to merge both into one solution.
 *
 * @package    Core
 * @subpackage GUI
 */
class cGuiScrollList
{

    /**
     * Data container.
     *
     * @var array
     */
    public $data = [];

    /**
     * Header container.
     *
     * @var array
     */
    public $header = [];

    /**
     * Number of records displayed per page.
     *
     * @var string
     */
    public $resultsPerPage;

    /**
     * Start page.
     *
     * @var int
     */
    public $listStart;

    /**
     * Sortable flags for rows.
     *
     * @var array
     */
    public $sortable;

    /**
     * sortlink
     *
     * @var cHTMLLink
     */
    public $sortlink;

    /**
     * Table item
     *
     * @var cHTMLTable
     */
    public $objTable;

    /**
     * Header row
     *
     * @var cHTMLTableRow
     */
    public $objHeaderRow;

    /**
     * Header item
     *
     * @var cHTMLTableHead
     */
    public $objHeaderItem;

    /**
     * Header item
     *
     * @var cHTMLTableRow
     */
    public $objRow;

    /**
     * Header item
     *
     * @var cHTMLTableData
     */
    public $objItem;

    /**
     * @var string
     */
    public $sortkey;

    /**
     * @var int - SORT_ASC or SORT_DESC
     */
    public $sortmode;

    /**
     * Constructor to create an instance of this class.
     *
     * @param bool $defaultStyle [optional]
     *        use the default style for object initializing?
     * @param string $action [optional]
     *        Action (action name) for the link
     */
    public function __construct(bool $defaultStyle = true, string $action = "")
    {
        $this->resultsPerPage = 0;
        $this->listStart = 1;
        $this->sortable = [];

        $this->objTable = new cHTMLTable();
        if ($defaultStyle) {
            $this->objTable->setClass("generic");
        }

        $this->objHeaderRow = new cHTMLTableRow();

        $this->objHeaderItem = new cHTMLTableHead();

        $this->objRow = new cHTMLTableRow();

        $this->objItem = new cHTMLTableData();

        $this->sortlink = new cHTMLLink();
        $this->sortlink->setClass('scroll_list_sort_link');
        $this->sortlink->setCLink(cRegistry::getArea(), cRegistry::getFrame(), $action);
    }

    /**
     * Sets the sortable flag for a specific row.
     *
     * $obj->setSortable(true);
     *
     * @param int $key
     * @param bool $sortable
     *         true or false
     */
    public function setSortable(int $key, bool $sortable)
    {
        $this->sortable[$key] = $sortable;
    }

    /**
     * Sets the custom parameters for sortable links.
     *
     * $obj->setCustom($key, $custom);
     *
     * @param string $key
     *         Custom entry key
     * @param string $custom
     *         Custom entry value
     */
    public function setCustom(string $key, string $custom)
    {
        $this->sortlink->setCustom($key, $custom);
    }

    /**
     * Is called when a new row is rendered.
     *
     * @param int $row
     *         The current row which is being rendered
     */
    public function onRenderRow(int $row)
    {
        $this->objRow->setStyle("white-space:nowrap;");
    }

    /**
     * Is called when a new column is rendered.
     *
     * @param int $column
     *         The current column which is being rendered
     */
    public function onRenderColumn(int $column)
    {
    }

    /**
     * Sets header data.
     *
     * Note: This public function eats as many parameters as you specify.
     *
     * Example:
     * $obj->setHeader("foo", "bar");
     *
     * Make sure that the amount of parameters stays the same for all
     * setData calls in a single object.
     *
     * @param mixed ...$values
     *         Additional parameters (data)
     * @noinspection PhpUnusedParameterInspection
     */
    public function setHeader(...$values)
    {
        $numArgs = func_num_args();

        for ($i = 0; $i < $numArgs; $i++) {
            $this->header[$i] = func_get_arg($i);
        }
    }

    /**
     * Sets data.
     *
     * Note: This public function eats as many parameters as you specify.
     *
     * Example:
     * $obj->setData(0, "foo", "bar");
     *
     * Make sure that the amount of parameters stays the same for all
     * setData calls in a single object. Also make sure that your index
     * starts from 0 and ends with the actual number - 1.
     *
     * @param int $index
     *         Numeric index
     * @param mixed ...$values
     *         Additional parameters (data)
     * @noinspection PhpUnusedParameterInspection
     */
    public function setData(int $index, ...$values)
    {
        $numArgs = func_num_args();

        for ($i = 1; $i < $numArgs; $i++) {
            $this->data[$index][$i] = func_get_arg($i);
        }
    }

    /**
     * Sets hidden data.
     *
     * Note: This public function eats as many parameters as you specify.
     *
     * Example:
     * $obj->setHiddenData(0, "foo", "bar");
     *
     * Make sure that the amount of parameters stays the same for all
     * setData calls in a single object. Also make sure that your index
     * starts from 0 and ends with the actual number - 1.
     *
     * @param int $index
     *         Numeric index
     * @param mixed ...$values
     *         Additional parameters (data)
     * @noinspection PhpUnusedParameterInspection
     */
    public function setHiddenData(int $index, ...$values)
    {
        $numArgs = func_num_args();

        for ($i = 1; $i < $numArgs; $i++) {
            $this->data[$index]["hiddendata"][$i] = func_get_arg($i);
        }
    }

    /**
     * Sets the number of records per page.
     *
     * @param int $resultsPerPage
     *         Amount of records per page
     */
    public function setResultsPerPage(int $resultsPerPage)
    {
        $this->resultsPerPage = $resultsPerPage;
    }

    /**
     * Sets the starting page number.
     *
     * @param int $listStart
     *         Page number on which the list display starts
     */
    public function setListStart(int $listStart)
    {
        $this->listStart = $listStart;
    }

    /**
     * Returns the current page.
     *
     * @return int
     *         Current page number
     */
    public function getCurrentPage(): int
    {
        if ($this->resultsPerPage == 0) {
            return 1;
        }

        return $this->listStart;
    }

    /**
     * Returns the amount of pages.
     *
     * @return int
     *         Amount of pages
     */
    public function getNumPages(): int
    {
        return (int) ceil(count($this->data) / $this->resultsPerPage);
    }

    /**
     * Sorts the list by a given field and a given order.
     *
     * @param int $field
     *         Field index
     * @param string $order 
     *         'ASC' or 'DESC'
     */
    public function sort(int $field, string $order = 'ASC')
    {
        $this->sortkey = $field;
        $this->sortmode = ($order === 'DESC') ? SORT_DESC : SORT_ASC;

        $field = $field + 1;
        $this->data = cArray::csort($this->data, "$field", $this->sortmode);
    }

    /**
     * Field converting facility.
     * Needs to be overridden in the child class to work properly.
     *
     * @param int $field
     *         Field index
     * @param string|mixed $value
     *         Field value
     * @param array $hiddenData
     * @return string
     */
    public function convert(int $field, $value, array $hiddenData): string
    {
        return (string) $value;
    }

    /**
     * Outputs or optionally returns.
     *
     * @param bool $return [optional]
     *         If true, returns the list
     * @return string|void
     */
    public function render(bool $return = true)
    {
        $currentPage = $this->getCurrentPage();

        $itemStart = (($currentPage - 1) * $this->resultsPerPage) + 1;

        $headerOutput = "";
        $output = "";

        // Render header
        foreach ($this->header as $key => $value) {
            if (is_array($this->sortable)) {
                if (array_key_exists($key, $this->sortable) && $this->sortable[$key]) {
                    $this->sortlink->setContent($value);
                    $this->sortlink->setCustom("sortby", $key);

                    if ($this->sortkey == $key && $this->sortmode == SORT_ASC) {
                        $this->sortlink->setCustom("sortmode", "DESC");
                    } else {
                        $this->sortlink->setCustom("sortmode", "ASC");
                    }

                    $this->objHeaderItem->setContent($this->sortlink->render());
                    $headerOutput .= $this->objHeaderItem->render();
                } else {
                    $this->objHeaderItem->setContent($value);
                    $headerOutput .= $this->objHeaderItem->render();
                }
            } else {
                $this->objHeaderItem->setContent($value);
                $headerOutput .= $this->objHeaderItem->render();
            }
            $this->objHeaderItem->advanceID();
        }

        $this->objHeaderRow->setContent($headerOutput);

        $headerOutput = $this->objHeaderRow->render();

        if ($this->resultsPerPage == 0) {
            $itemEnd = count($this->data) - ($itemStart - 1);
        } else {
            $itemEnd = $currentPage * $this->resultsPerPage;
        }

        if ($itemEnd > count($this->data)) {
            $itemEnd = count($this->data);
        }

        for ($i = $itemStart; $i < $itemEnd + 1; $i++) {

            // At the last entry we get NULL as result
            // This produce an error, therefore use continue
            if ($this->data[$i - 1] == NULL) {
                continue;
            }

            $items = "";

            $this->onRenderRow($i);

            foreach ($this->data[$i - 1] as $key => $value) {
                $this->onRenderColumn($key);

                if ($key != "hiddendata") {
                    $hiddendata = !empty($this->data[$i - 1]["hiddendata"]) && is_array($this->data[$i - 1]["hiddendata"]) ? $this->data[$i - 1]["hiddendata"] : [];

                    $this->objItem->setContent($this->convert($key, $value, $hiddendata));
                    $items .= $this->objItem->render();
                }
                $this->objItem->advanceID();
            }

            $this->objRow->setContent($items);

            $output .= $this->objRow->render();
            $this->objRow->advanceID();
        }

        $this->objTable->setContent($headerOutput . $output);

        $output = $this->objTable->render();

        if ($return) {
            return $output;
        } else {
            echo $output;
        }
    }

}
