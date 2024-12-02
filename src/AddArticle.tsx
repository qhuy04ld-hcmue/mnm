import { RouterProvider, createBrowserRouter } from "react-router-dom";
import React, { useState } from "react";
import { Outlet } from 'react-router-dom';

function HomeLayout() {
  return (
    <div className="container" style={containerStyles}>
      <h1 style={titleStyles}>Article Management</h1>
      <Outlet />
    </div>
  );
}

function AddArticle() {
  const [articles, setArticles] = useState<
    { id: number; type: string; description: string; content: string; date: string }[]
  >([]);

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const formData = new FormData(e.currentTarget);
    const newArticle = {
      id: Number(formData.get("id")),
      type: formData.get("type") as string,
      description: formData.get("description") as string,
      content: formData.get("content") as string,
      date: formData.get("date") as string,
    };

    setArticles((prev) => [...prev, newArticle]);
    e.currentTarget.reset();
  };

  return (
    <div className="form-container" style={formStyles}>
      <form onSubmit={handleSubmit} className="form">
        <h2 style={formTitleStyles}>Add Article</h2>
        <div className="form-group">
          <label>Article ID:</label>
          <input type="number" name="id" required className="form-input" style={inputStyles} />
        </div>
        <div className="form-group">
          <label>Article Type:</label>
          <input type="text" name="type" required className="form-input" style={inputStyles} />
        </div>
        <div className="form-group">
          <label>Description:</label>
          <textarea name="description" required className="form-input" style={textareaStyles} />
        </div>
        <div className="form-group">
          <label>Content:</label>
          <textarea name="content" required className="form-input" style={textareaStyles} />
        </div>
        <div className="form-group">
          <label>Publish Date:</label>
          <input type="date" name="date" required className="form-input" style={inputStyles} />
        </div>
        <button type="submit" className="submit-button" style={buttonStyles}>Add Article</button>
      </form>
      <div className="articles-list" style={tableContainerStyles}>
        <h3 style={tableTitleStyles}>Articles</h3>
        <table style={tableStyles}>
          <thead>
            <tr style={tableHeaderStyles}>
              <th>ID</th>
              <th>Type</th>
              <th>Description</th>
              <th>Content</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            {articles.map((article, index) => (
              <tr key={index} style={tableRowStyles}>
                <td>{article.id}</td>
                <td>{article.type}</td>
                <td>{article.description}</td>
                <td>{article.content}</td>
                <td>{article.date}</td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
}

// Apply styles
const containerStyles: React.CSSProperties = {
  padding: "20px",
  maxWidth: "1200px",
  margin: "auto",
};

const titleStyles: React.CSSProperties = {
  textAlign: "center",
  marginBottom: "20px",
};

const formStyles: React.CSSProperties = {
  maxWidth: "600px",
  margin: "auto",
  padding: "20px",
  background: "#f9f9f9",
  borderRadius: "10px",
  boxShadow: "0 5px 15px rgba(0, 0, 0, 0.1)",
};

const formTitleStyles: React.CSSProperties = {
  textAlign: "center",
  marginBottom: "20px",
};

const inputStyles: React.CSSProperties = {
  width: "100%",
  padding: "10px",
  margin: "10px 0",
  borderRadius: "5px",
  border: "1px solid #ddd",
};

const textareaStyles: React.CSSProperties = {
  width: "100%",
  padding: "10px",
  margin: "10px 0",
  borderRadius: "5px",
  border: "1px solid #ddd",
  height: "80px",
};

const buttonStyles: React.CSSProperties = {
  width: "100%",
  padding: "10px",
  backgroundColor: "#007BFF",
  color: "#fff",
  border: "none",
  borderRadius: "5px",
  cursor: "pointer",
  fontSize: "16px",
};

const tableContainerStyles: React.CSSProperties = {
  marginTop: "20px",
};

const tableTitleStyles: React.CSSProperties = {
  textAlign: "center",
  marginBottom: "10px",
};

const tableStyles: React.CSSProperties = {
  width: "100%",
  borderCollapse: "collapse",
  marginTop: "10px",
};

const tableHeaderStyles: React.CSSProperties = {
  backgroundColor: "#007BFF",
  color: "#fff",
  textAlign: "left",
};

const tableRowStyles: React.CSSProperties = {
  textAlign: "left",
  borderBottom: "1px solid #ddd",
  padding: "10px",
  height: "40px",
};

const router = createBrowserRouter([
  {
    path: "/",
    element: <HomeLayout />,
    children: [
      {
        index: true,
        element: <AddArticle />,
      },
    ],
  },
]);

function App1() {
  return <RouterProvider router={router} />;
}

export default App1;


/* anh van con thuong em nhieu ma
import { RouterProvider, createBrowserRouter } from "react-router-dom";
import React, { useState } from "react";
import { Outlet } from 'react-router-dom';

function HomeLayout() {
  return (
    <div className="container">
      <h1>Article Management</h1>
      <Outlet />
    </div>
  );
}

function AddArticle() {
  const [articles, setArticles] = useState<
    { id: number; type: string; description: string; content: string; date: string }[]
  >([]);

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const formData = new FormData(e.currentTarget);
    const newArticle = {
      id: Number(formData.get("id")),
      type: formData.get("type") as string,
      description: formData.get("description") as string,
      content: formData.get("content") as string,
      date: formData.get("date") as string,
    };

    setArticles((prev) => [...prev, newArticle]);
    e.currentTarget.reset();
  };

  return (
    <div className="form-container" style={formStyles}>
      <form onSubmit={handleSubmit} className="form">
        <h2>Add Article</h2>
        <div className="form-group">
          <label>Article ID:</label>
          <input type="number" name="id" required className="form-input" />
        </div>
        <div className="form-group">
          <label>Article Type:</label>
          <input type="text" name="type" required className="form-input" />
        </div>
        <div className="form-group">
          <label>Description:</label>
          <textarea name="description" required className="form-input" />
        </div>
        <div className="form-group">
          <label>Content:</label>
          <textarea name="content" required className="form-input" />
        </div>
        <div className="form-group">
          <label>Publish Date:</label>
          <input type="date" name="date" required className="form-input" />
        </div>
        <button type="submit" className="submit-button">Add Article</button>
      </form>
      <div className="articles-list">
        <h3>Articles</h3>
        {articles.map((article, index) => (
          <div key={index} className="article-item">
            <p><strong>ID:</strong> {article.id}</p>
            <p><strong>Type:</strong> {article.type}</p>
            <p><strong>Description:</strong> {article.description}</p>
            <p><strong>Content:</strong> {article.content}</p>
            <p><strong>Date:</strong> {article.date}</p>
          </div>
        ))}
      </div>
    </div>
  );
}

// Apply styles to the form container
const formStyles: React.CSSProperties = {
  maxWidth: "600px",
  margin: "auto",
  padding: "20px",
  background: "#f9f9f9",
  borderRadius: "10px",
  boxShadow: "0 5px 15px rgba(0, 0, 0, 0.1)",
};

const router = createBrowserRouter([
  {
    path: "/",
    element: <HomeLayout />,
    children: [
      {
        index: true,
        element: <AddArticle />,
      },
    ],
  },
]);

function App1() {
  return <RouterProvider router={router} />;
}

export default App1;
*/



































// CSS nâng cao (thêm vào file CSS hoặc trong phần CSS-in-JS)

/*
import { RouterProvider, createBrowserRouter } from "react-router-dom";
import React, { useState } from "react";
import { Outlet } from 'react-router-dom';

function HomeLayout() {
  return (
    <div className="container">
      <h1>Article Management</h1>
      <Outlet />
    </div>
  );
}

function AddArticle() {
  const [articles, setArticles] = useState<
    { id: number; type: string; description: string; content: string; date: string }[]
  >([]);

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const formData = new FormData(e.currentTarget);
    const newArticle = {
      id: Number(formData.get("id")),
      type: formData.get("type") as string,
      description: formData.get("description") as string,
      content: formData.get("content") as string,
      date: formData.get("date") as string,
    };

    setArticles((prev) => [...prev, newArticle]);
    e.currentTarget.reset();
  };

  return (
    <div className="form-container">
      <form onSubmit={handleSubmit} className="form">
        <h2>Add Article</h2>
        <div className="form-group">
          <label>Article ID:</label>
          <input type="number" name="id" required className="form-input" />
        </div>
        <div className="form-group">
          <label>Article Type:</label>
          <input type="text" name="type" required className="form-input" />
        </div>
        <div className="form-group">
          <label>Description:</label>
          <textarea name="description" required className="form-input" />
        </div>
        <div className="form-group">
          <label>Content:</label>
          <textarea name="content" required className="form-input" />
        </div>
        <div className="form-group">
          <label>Publish Date:</label>
          <input type="date" name="date" required className="form-input" />
        </div>
        <button type="submit" className="submit-button">Add Article</button>
      </form>
      <div className="articles-list">
        <h3>Articles</h3>
        {articles.map((article, index) => (
          <div key={index} className="article-item">
            <p><strong>ID:</strong> {article.id}</p>
            <p><strong>Type:</strong> {article.type}</p>
            <p><strong>Description:</strong> {article.description}</p>
            <p><strong>Content:</strong> {article.content}</p>
            <p><strong>Date:</strong> {article.date}</p>
          </div>
        ))}
      </div>
    </div>
  );
}

// Các kiểu dáng CSS mới
const formStyles: React.CSSProperties = {
  maxWidth: "600px",
  margin: "auto",
  padding: "20px",
  background: "#f9f9f9",
  borderRadius: "10px",
  boxShadow: "0 5px 15px rgba(0, 0, 0, 0.1)",
};

const router = createBrowserRouter([
  {
    path: "/",
    element: <HomeLayout />,
    children: [
      {
        index: true,
        element: <AddArticle />,
      },
    ],
  },
]);

function App1() {
  return <RouterProvider router={router} />;
}

export default App1;
*/
// CSS nâng cao (thêm vào file CSS hoặc trong phần CSS-in-JS)
