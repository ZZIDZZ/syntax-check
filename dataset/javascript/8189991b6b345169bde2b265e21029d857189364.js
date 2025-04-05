async function origin(req, init) {
  const url = new URL(req.url)
  const status = parseInt(url.searchParams.get('status') || '200')

  if (status === 200) {
    return new Response(`hello from ${req.url} on ${new Date()}`)
  } else {
    return new Response(`an error! Number ${status}`, { status: status })
  }
}