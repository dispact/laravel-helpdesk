<button class="text-orange-500 hover:text-orange-700 
    dark:text-orange-400 dark:hover:text-orange-300"
    onClick="updateItem('{{ $id }}')">
    <x-icons.icon name="action-edit"/>
</button>
<button class="text-red-500 hover:text-red-700
    dark:text-red-400 dark:hover:text-red-300"
    onClick="deleteItem('{{ $id }}')">
    <x-icons.icon name="action-delete"/>
</button>