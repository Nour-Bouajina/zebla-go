let map;
function getMap() {
  map = new Microsoft.Maps.Map("#map", {
    credentials: 'AskZI7hJZdiLqVVluq4uSDYNQxipttq0GGvJEv3mceRGXyiE8O_PrW4wM5s5nJ4U'
  });
}

function addPin(latitude, longitude, title, description, pincolor) {
    var location = new Microsoft.Maps.Location(latitude, longitude);
    var pin = new Microsoft.Maps.Pushpin(location, {color: pincolor});
    pin.metadata = {
      title: title,
      description: description
    };
    Microsoft.Maps.Events.addHandler(pin, 'click', function (e) {
      var infobox = new Microsoft.Maps.Infobox(pin.getLocation(), {
        title: pin.metadata.title,
        description: pin.metadata.description
      });
      infobox.setMap(map);
    });
    map.entities.push(pin);
  }