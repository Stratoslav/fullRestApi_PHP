let id = null;
async function getPosts() {
  const res = await fetch("http://items/posts");
  const data = await res.json();
  document.querySelector(".posts_list").innerHTML = "";
  data.forEach((item) => {
    document.querySelector(".posts_list").innerHTML += `
            
            
            <li class="post_list-item">
            <h3>${item.title}</h3>
                        <p class="post_list-text">${item.body}</p>
    <button  onclick = deletePost(${item.id})>Delete</button>
            <a href="#"   onclick = "selectPost(${item.id}, '${item.title}', '${item.body}') ">Edit</a>
            </li>
            

            
        

            `;
  });
}

getPosts();

async function addPost() {
  const title = document.getElementById("title").value;
  const body = document.getElementById("body").value;

  const formData = new FormData();
  formData.append("title", title);
  formData.append("body", body);
  const res = await fetch("http://items/posts", {
    method: "POST",
    body: formData,
  });

  const data = await res.json();
  if (data.status === true) {
    await getPosts();
  }
}

async function deletePost(id) {
  const res = await fetch(`http://items/posts/${id}`, {
    method: "DELETE",
  });
  const data = await res.json();
  if (data.status === true) {
    await getPosts();
  }
}

function selectPost(idi, title, body) {
  id = idi;

  document.getElementById("title-edit").value = title;
  document.getElementById("body-edit").value = body;
}

async function updatePost() {
  const title = document.getElementById("title-edit").value;
  body = document.getElementById("body-edit").value;

  const data = {
    title: title,
    body: body,
  };

  fetch(`http://items/posts/${id}`, {
    method: "PATCH",
    body: JSON.stringify(data),
    headers: {
      "Content-type": "application/json",
    },
  })
    .then((res) => res.json())
    .then((data) => {
      if (data) {
        getPosts();
      }
    });
  debugger;
}
