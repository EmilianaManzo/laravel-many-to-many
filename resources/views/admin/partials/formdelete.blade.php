<form
action="{{$route}}"
method="post"
onsubmit="return confirm('{{$message}}')">
@csrf
@method('DELETE')
<button
type="submit"
class="btn btn-danger my-2 "
><i
class="fa-solid fa-trash"></i></button>
</form>
