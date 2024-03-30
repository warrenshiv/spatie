<div class="p-6 text-gray-900">
        {{ __("You're logged in!") }}
    </div>
   @can('edit articles')
   You can EDIT ARTICLES.
   @endcan
   @can('publish articles')
   You can PUBLISH ARTICLES.
   @endcan
   @can('only super-admins can see this section')
   Congratulations, you are a super-admin!
   @endcan