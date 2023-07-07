--
-- PostgreSQL database dump
--

-- Dumped from database version 12.15 (Ubuntu 12.15-0ubuntu0.20.04.1)
-- Dumped by pg_dump version 12.15 (Ubuntu 12.15-0ubuntu0.20.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: se_products; Type: TABLE; Schema: public; Owner: adm
--

CREATE TABLE public.se_products (
    id integer NOT NULL,
    name character varying(150),
    description text,
    image character varying(200),
    quantity integer,
    product_type_id integer,
    price money
);


ALTER TABLE public.se_products OWNER TO adm;

--
-- Name: product_id_seq; Type: SEQUENCE; Schema: public; Owner: adm
--

CREATE SEQUENCE public.product_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_id_seq OWNER TO adm;

--
-- Name: product_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: adm
--

ALTER SEQUENCE public.product_id_seq OWNED BY public.se_products.id;


--
-- Name: se_product_types; Type: TABLE; Schema: public; Owner: adm
--

CREATE TABLE public.se_product_types (
    id integer NOT NULL,
    name character varying(150),
    description text,
    tax_id integer
);


ALTER TABLE public.se_product_types OWNER TO adm;

--
-- Name: product_types_id_seq; Type: SEQUENCE; Schema: public; Owner: adm
--

CREATE SEQUENCE public.product_types_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_types_id_seq OWNER TO adm;

--
-- Name: product_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: adm
--

ALTER SEQUENCE public.product_types_id_seq OWNED BY public.se_product_types.id;


--
-- Name: se_sales; Type: TABLE; Schema: public; Owner: adm
--

CREATE TABLE public.se_sales (
    id integer NOT NULL,
    total double precision,
    total_taxes double precision
);


ALTER TABLE public.se_sales OWNER TO adm;

--
-- Name: sales_id_seq; Type: SEQUENCE; Schema: public; Owner: adm
--

CREATE SEQUENCE public.sales_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sales_id_seq OWNER TO adm;

--
-- Name: sales_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: adm
--

ALTER SEQUENCE public.sales_id_seq OWNED BY public.se_sales.id;


--
-- Name: se_sale_products; Type: TABLE; Schema: public; Owner: adm
--

CREATE TABLE public.se_sale_products (
    id integer NOT NULL,
    quantity integer,
    subtotal money,
    subtotaltaxes money,
    sale_id integer
);


ALTER TABLE public.se_sale_products OWNER TO adm;

--
-- Name: se_sale_products_id_seq; Type: SEQUENCE; Schema: public; Owner: adm
--

CREATE SEQUENCE public.se_sale_products_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.se_sale_products_id_seq OWNER TO adm;

--
-- Name: se_sale_products_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: adm
--

ALTER SEQUENCE public.se_sale_products_id_seq OWNED BY public.se_sale_products.id;


--
-- Name: se_taxes; Type: TABLE; Schema: public; Owner: adm
--

CREATE TABLE public.se_taxes (
    name character varying(150),
    value money,
    id integer NOT NULL
);


ALTER TABLE public.se_taxes OWNER TO adm;

--
-- Name: se_taxes_id_seq; Type: SEQUENCE; Schema: public; Owner: adm
--

CREATE SEQUENCE public.se_taxes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.se_taxes_id_seq OWNER TO adm;

--
-- Name: se_taxes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: adm
--

ALTER SEQUENCE public.se_taxes_id_seq OWNED BY public.se_taxes.id;


--
-- Name: se_users; Type: TABLE; Schema: public; Owner: adm
--

CREATE TABLE public.se_users (
    id integer NOT NULL,
    username character varying(50),
    password character varying(100),
    display_name character varying(100),
    email character varying(150)
);


ALTER TABLE public.se_users OWNER TO adm;

--
-- Name: se_users_id_seq; Type: SEQUENCE; Schema: public; Owner: adm
--

CREATE SEQUENCE public.se_users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.se_users_id_seq OWNER TO adm;

--
-- Name: se_users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: adm
--

ALTER SEQUENCE public.se_users_id_seq OWNED BY public.se_users.id;


--
-- Name: se_product_types id; Type: DEFAULT; Schema: public; Owner: adm
--

ALTER TABLE ONLY public.se_product_types ALTER COLUMN id SET DEFAULT nextval('public.product_types_id_seq'::regclass);


--
-- Name: se_products id; Type: DEFAULT; Schema: public; Owner: adm
--

ALTER TABLE ONLY public.se_products ALTER COLUMN id SET DEFAULT nextval('public.product_id_seq'::regclass);


--
-- Name: se_sale_products id; Type: DEFAULT; Schema: public; Owner: adm
--

ALTER TABLE ONLY public.se_sale_products ALTER COLUMN id SET DEFAULT nextval('public.se_sale_products_id_seq'::regclass);


--
-- Name: se_sales id; Type: DEFAULT; Schema: public; Owner: adm
--

ALTER TABLE ONLY public.se_sales ALTER COLUMN id SET DEFAULT nextval('public.sales_id_seq'::regclass);


--
-- Name: se_taxes id; Type: DEFAULT; Schema: public; Owner: adm
--

ALTER TABLE ONLY public.se_taxes ALTER COLUMN id SET DEFAULT nextval('public.se_taxes_id_seq'::regclass);


--
-- Name: se_users id; Type: DEFAULT; Schema: public; Owner: adm
--

ALTER TABLE ONLY public.se_users ALTER COLUMN id SET DEFAULT nextval('public.se_users_id_seq'::regclass);


--
-- Data for Name: se_product_types; Type: TABLE DATA; Schema: public; Owner: adm
--

COPY public.se_product_types (id, name, description, tax_id) FROM stdin;
\.


--
-- Data for Name: se_products; Type: TABLE DATA; Schema: public; Owner: adm
--

COPY public.se_products (id, name, description, image, quantity, product_type_id, price) FROM stdin;
\.


--
-- Data for Name: se_sale_products; Type: TABLE DATA; Schema: public; Owner: adm
--

COPY public.se_sale_products (id, quantity, subtotal, subtotaltaxes, sale_id) FROM stdin;
\.


--
-- Data for Name: se_sales; Type: TABLE DATA; Schema: public; Owner: adm
--

COPY public.se_sales (id, total, total_taxes) FROM stdin;
\.


--
-- Data for Name: se_taxes; Type: TABLE DATA; Schema: public; Owner: adm
--

COPY public.se_taxes (name, value, id) FROM stdin;
\.


--
-- Data for Name: se_users; Type: TABLE DATA; Schema: public; Owner: adm
--

COPY public.se_users (id, username, password, display_name, email) FROM stdin;
1	Username	password	Display Name	Email
2	Username	password	Display Name	Email
3	Username	5f4dcc3b5aa765d61d8327deb882cf99	Display Name	Email
4	Username	5f4dcc3b5aa765d61d8327deb882cf99	Display Name	Email
5	Username	5f4dcc3b5aa765d61d8327deb882cf99	Display Name	Email
6	Username	5f4dcc3b5aa765d61d8327deb882cf99	Display Name	Email
7	Username	5f4dcc3b5aa765d61d8327deb882cf99	Display Name	Email
8	Username	5f4dcc3b5aa765d61d8327deb882cf99	Display Name	Email
9	Username	5f4dcc3b5aa765d61d8327deb882cf99	Display Name	Email
\.


--
-- Name: product_id_seq; Type: SEQUENCE SET; Schema: public; Owner: adm
--

SELECT pg_catalog.setval('public.product_id_seq', 25, true);


--
-- Name: product_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: adm
--

SELECT pg_catalog.setval('public.product_types_id_seq', 21, true);


--
-- Name: sales_id_seq; Type: SEQUENCE SET; Schema: public; Owner: adm
--

SELECT pg_catalog.setval('public.sales_id_seq', 22, true);


--
-- Name: se_sale_products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: adm
--

SELECT pg_catalog.setval('public.se_sale_products_id_seq', 9, true);


--
-- Name: se_taxes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: adm
--

SELECT pg_catalog.setval('public.se_taxes_id_seq', 30, true);


--
-- Name: se_users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: adm
--

SELECT pg_catalog.setval('public.se_users_id_seq', 9, true);


--
-- PostgreSQL database dump complete
--

