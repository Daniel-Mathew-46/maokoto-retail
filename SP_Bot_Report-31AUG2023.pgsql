--
-- PostgreSQL database dump
--

-- Dumped from database version 14.9 (Ubuntu 14.9-0ubuntu0.22.04.1)
-- Dumped by pg_dump version 14.9 (Ubuntu 14.9-0ubuntu0.22.04.1)

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

--
-- Name: maokoto; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA maokoto;


ALTER SCHEMA maokoto OWNER TO postgres;

--
-- Name: SetNot_Customer_Id_Seq; Type: SEQUENCE; Schema: maokoto; Owner: postgres
--

CREATE SEQUENCE maokoto."SetNot_Customer_Id_Seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
    CYCLE;


ALTER TABLE maokoto."SetNot_Customer_Id_Seq" OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: SetNot_Customer; Type: TABLE; Schema: maokoto; Owner: postgres
--

CREATE TABLE maokoto."SetNot_Customer" (
    "Id" bigint DEFAULT nextval('maokoto."SetNot_Customer_Id_Seq"'::regclass) NOT NULL,
    "CustomerName" character varying(500) NOT NULL,
    "CustomerId" character varying(1000) NOT NULL,
    "IdentityTypeId" bigint NOT NULL,
    "IdentityTypeCode" character varying(1000),
    "CustomerEmail" character varying(1000),
    "CustomerPhone" character varying(1000),
    "CustomerPhone1" character varying(100),
    "CustomerAddress" character varying(1000)
);


ALTER TABLE maokoto."SetNot_Customer" OWNER TO postgres;

--
-- Name: SetNot_IdentityType_IdentityTypeId_Seq; Type: SEQUENCE; Schema: maokoto; Owner: postgres
--

CREATE SEQUENCE maokoto."SetNot_IdentityType_IdentityTypeId_Seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
    CYCLE;


ALTER TABLE maokoto."SetNot_IdentityType_IdentityTypeId_Seq" OWNER TO postgres;

--
-- Name: SetNot_IdentityType; Type: TABLE; Schema: maokoto; Owner: postgres
--

CREATE TABLE maokoto."SetNot_IdentityType" (
    "IdentityTypeId" bigint DEFAULT nextval('maokoto."SetNot_IdentityType_IdentityTypeId_Seq"'::regclass) NOT NULL,
    "IdentityTypeName" character varying(1000),
    "IdentityTypeCode" character varying(1000)
);


ALTER TABLE maokoto."SetNot_IdentityType" OWNER TO postgres;

--
-- Data for Name: SetNot_Customer; Type: TABLE DATA; Schema: maokoto; Owner: postgres
--

COPY maokoto."SetNot_Customer" ("Id", "CustomerName", "CustomerId", "IdentityTypeId", "IdentityTypeCode", "CustomerEmail", "CustomerPhone", "CustomerPhone1", "CustomerAddress") FROM stdin;
\.


--
-- Data for Name: SetNot_IdentityType; Type: TABLE DATA; Schema: maokoto; Owner: postgres
--

COPY maokoto."SetNot_IdentityType" ("IdentityTypeId", "IdentityTypeName", "IdentityTypeCode") FROM stdin;
1	TIN	1
2	Driving License	2
\.


--
-- Name: SetNot_Customer_Id_Seq; Type: SEQUENCE SET; Schema: maokoto; Owner: postgres
--

SELECT pg_catalog.setval('maokoto."SetNot_Customer_Id_Seq"', 1, false);


--
-- Name: SetNot_IdentityType_IdentityTypeId_Seq; Type: SEQUENCE SET; Schema: maokoto; Owner: postgres
--

SELECT pg_catalog.setval('maokoto."SetNot_IdentityType_IdentityTypeId_Seq"', 2, true);


--
-- Name: SetNot_Customer SetNot_Customer_Id_PK; Type: CONSTRAINT; Schema: maokoto; Owner: postgres
--

ALTER TABLE ONLY maokoto."SetNot_Customer"
    ADD CONSTRAINT "SetNot_Customer_Id_PK" PRIMARY KEY ("Id");


--
-- Name: SetNot_IdentityType SetNot_IdentityType_IdentityTypeCode_UNIQ; Type: CONSTRAINT; Schema: maokoto; Owner: postgres
--

ALTER TABLE ONLY maokoto."SetNot_IdentityType"
    ADD CONSTRAINT "SetNot_IdentityType_IdentityTypeCode_UNIQ" UNIQUE ("IdentityTypeCode");


--
-- Name: SetNot_IdentityType SetNot_IdentityType_IdentityTypeId_PK; Type: CONSTRAINT; Schema: maokoto; Owner: postgres
--

ALTER TABLE ONLY maokoto."SetNot_IdentityType"
    ADD CONSTRAINT "SetNot_IdentityType_IdentityTypeId_PK" PRIMARY KEY ("IdentityTypeId");


--
-- PostgreSQL database dump complete
--

