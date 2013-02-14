<!-- form_assistant/templates/template.right_bottom_data.tpl -->

{*

AUTHOR marcus.gnass@4fb.de

*}
<fieldset>
    <legend>{$trans.legend}</legend>
{if true neq $form->isLoaded()}
    <p>{$trans.pleaseSaveFirst}</p>
{else if not $fields|is_array}
    {* an error is a string instead of an array *}
    {$fields}
{else if not $data|is_array}
    {* an error is a string instead of an array *}
    {$data}
{else}
    <p><a href="{$exportUrl}">{$trans.export}</a></p>
    <table border="1">
        <tr>
            <th>id</th>
    {foreach from=$fields item=field}
        {* skip columns that dont store data into DB *}
        {if NULL eq $field->getDbDataType()}{continue}{/if}
        {assign var=columnName value=$field->get('column_name')}
        {if 0 eq $columnName|strlen}
            <th>&nbsp;</th>
        {else}
            <th>{$columnName}</th>
        {/if}
    {/foreach}
        </tr>
    {foreach from=$data item=row}
        <tr>
            <td>{$row.id}</td>
        {foreach from=$fields item=field}
            {* skip columns that dont store data into DB *}
            {if NULL eq $field->getDbDataType()}{continue}{/if}
            {assign var=columnName value=$field->get('column_name')}
            {assign var=columnData value=$row.$columnName}
            {if 0 eq $columnData|strlen}
            <td>&nbsp;</td>
            {else if '9' eq $field->get('field_type')}
            {* display INPUTFILE values as link *}
            <td><a href="{$getFileUrl}&name={$columnData}&file={$form->get('data_table')}_{$row.id}_{$columnName}">{$columnData}</a></td>
            {else}
            <td>{$columnData}</td>
            {/if}
        {/foreach}
        </tr>
    {/foreach}
    </table>
{/if}
</fieldset>

<!-- /form_assistant/templates/template.right_bottom_data.tpl -->
