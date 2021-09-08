# Rest Albums

A simple docker image to create albums.

Supports two endpoints:

- `GET` - localhost - A list of stored albums. This can be combined with a `id=2` query parameter, to load a specific album.
- `POST` - localhost - This requires the `name` parameter. Will return an error otherwise. Saves the sent album to the list of albums. 