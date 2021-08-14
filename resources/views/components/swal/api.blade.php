@props(['title', 'buttonText', 'link'])
<button onClick="swal()">
    <x-slot name="trigger"/>
</button>

<script>
function swal() {
    Swal.fire({
        title: '{{ $title }}',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: '{{ $buttonText }}',
    }).then((result) => {
        if (result.isConfirmed) {
            alert('hey');
        }
    })
}
</script>

{{-- preConfirm: (login) => {
    return fetch(`//api.github.com/users/${login}`)
      .then(response => {
        if (!response.ok) {
          throw new Error(response.statusText)
        }
        return response.json()
      })
      .catch(error => {
        Swal.showValidationMessage(
          `Request failed: ${error}`
        )
      })
  },
  allowOutsideClick: () => !Swal.isLoading()
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
      title: `${result.value.login}'s avatar`,
      imageUrl: result.value.avatar_url
    })
  }
}) --}}